<?php

/**
 * This file is part of the bitbucket-api package.
 *
 * (c) Alexandru G. <alex@gentle.ro>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Bitbucket\API\Http\Listener;

use Buzz\Message\MessageInterface;
use Buzz\Message\RequestInterface;
use JacobKiers\OAuth\SignatureMethod\SignatureMethodInterface;
use JacobKiers\OAuth\Consumer\ConsumerInterface;
use JacobKiers\OAuth\Token\TokenInterface;
use JacobKiers\OAuth as OAuth1;

/**
 * @author  Alexandru G.    <alex@gentle.ro>
 */
class OAuthListener implements ListenerInterface
{
    const ENDPOINT_REQUEST_TOKEN    = 'oauth/request_token';
    const ENDPOINT_ACCESS_TOKEN     = 'oauth/access_token';
    const ENDPOINT_AUTHORIZE        = 'oauth/authenticate';

    /**
     * @var array
     */
    protected $config = array(
        'oauth_consumer_key'        => 'anon',
        'oauth_consumer_secret'     => 'anon',
        'oauth_token'               => '',
        'oauth_token_secret'        => '',
        'oauth_signature_method'    => 'HMAC-SHA1',
        'oauth_callback'            => '',
        'oauth_verifier'            => '',
        'oauth_version'             => '1.0'
    );

    /**
     * @var SignatureMethodInterface
     */
    protected $signature;

    /**
     * @var TokenInterface
     */
    protected $token;

    /**
     * @var ConsumerInterface
     */
    protected $consumer;

    public function __construct(
        array $config,
        SignatureMethodInterface $signature = null,
        TokenInterface $token = null,
        ConsumerInterface $consumer = null
    ) {
        $this->config       = array_merge($this->config, $config);
        $this->signature    = (!is_null($signature)) ? $signature : $this->getSigner();

        $this->token = (!is_null($token)) ?
            $token :
            empty($this->config['oauth_token']) ?
                new OAuth1\Token\NullToken :
                new OAuth1\Token\Token($this->config['oauth_token'], $this->config['oauth_token_secret'])
        ;

        $this->consumer = (!is_null($consumer)) ?
            $consumer :
            new OAuth1\Consumer\Consumer(
                $this->config['oauth_consumer_key'],
                $this->config['oauth_consumer_secret']
            )
        ;
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'oauth';
    }

    /**
     * {@inheritDoc}
     */
    public function preSend(RequestInterface $request)
    {
        $params = $this->getParametersToSign($request);
        $req    = OAuth1\Request\Request::fromConsumerAndToken(
            $this->consumer,
            $this->token,
            $request->getMethod(),
            $request->getUrl(),
            $params
        );

        $req->signRequest($this->signature, $this->consumer, $this->token);

        $request->addHeader($req->toHeader());
    }

    /**
     * {@inheritDoc}
     */
    public function postSend(RequestInterface $request, MessageInterface $response)
    {
    }

    /**
     * Include OAuth and request body parameters
     *
     * @access protected
     * @param  RequestInterface $request
     * @return array
     *
     * @see http://oauth.net/core/1.0/#sig_norm_param
     */
    protected function getParametersToSign(RequestInterface $request)
    {
        $params         = $this->getOAuthParameters($request);

        if ($request->getHeader('Content-Type') === 'application/x-www-form-urlencoded') {
            $params = array_merge($params, $this->getContentAsParameters($request));
        }

        return $params;
    }

    /**
     * Include/exclude optional parameters
     *
     * The exclusion/inclusion is based on current request resource
     *
     * @access protected
     * @param  RequestInterface $request
     * @return array
     */
    protected function getOAuthParameters(RequestInterface $request)
    {
        $params = $this->filterOAuthParameters(array('oauth_token', 'oauth_version'));

        if ($this->isEndpointRequested(self::ENDPOINT_REQUEST_TOKEN, $request)) {
            $params = $this->filterOAuthParameters(array('oauth_callback'));
        } elseif ($this->isEndpointRequested(self::ENDPOINT_ACCESS_TOKEN, $request)) {
            $params = $this->filterOAuthParameters(array('oauth_token', 'oauth_verifier'));
        }

        return $params;
    }

    /**
     * White list based filter
     *
     * @param  array $include
     * @return array
     */
    protected function filterOAuthParameters(array $include)
    {
        $final = array();

        foreach ($include as $key => $value) {
            if (!empty($this->config[$value])) {
                $final[$value] = $this->config[$value];
            }
        }

        return $final;
    }

    /**
     * Transform request content to associative array
     *
     * @access protected
     * @param  RequestInterface $request
     * @return array
     */
    protected function getContentAsParameters(RequestInterface $request)
    {
        parse_str($request->getContent(), $parts);

        return $parts;
    }

    /**
     * Check if specified endpoint is in current request
     *
     * @param  string           $endpoint
     * @param  RequestInterface $request
     * @return bool
     */
    protected function isEndpointRequested($endpoint, RequestInterface $request)
    {
        return strpos($request->getResource(), $endpoint) !== false;
    }

    /**
     * Bitbucket supports only HMAC-SHA1 and PlainText signatures.
     *
     * For better security, HMAC-SHA1 is the default one.
     *
     * @return \JacobKiers\OAuth\SignatureMethod\SignatureMethodInterface
     */
    protected function getSigner()
    {
        $signature = 'HmacSha1';

        if ($this->config['oauth_signature_method'] == 'PLAINTEXT') {
            $signature = 'PlainText';
        }

        $class = '\JacobKiers\OAuth\SignatureMethod\\'.$signature;

        return new $class;
    }
}
