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
        'oauth_version'             => ''
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
    )
    {
        $this->config       = array_merge($this->config, $config);
        $this->signature    = (!is_null($signature)) ? $signature : $this->getSigner();

        $this->token = (!is_null($token)) ?
            $token :
            !isset($this->config['oauth_token']) ?
                new OAuth1\Token\NullToken :
                new OAuth1\Token\Token($this->config['oauth_token'], $this->config['oauth_token_secret'])
        ;

        $this->consumer = (!is_null($consumer)) ?
            $consumer :
            new OAuth1\Consumer\Consumer(
                $this->config['oauth_consumer_key'], $this->config['oauth_consumer_secret']
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
    {}

    /**
     * {@inheritDoc}
     */
    public function postSend(RequestInterface $request, MessageInterface $response)
    {}

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
