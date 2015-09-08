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

use Bitbucket\API\Exceptions\ForbiddenAccessException;
use Bitbucket\API\Exceptions\HttpResponseException;
use Bitbucket\API\Http\Client;
use Bitbucket\API\Http\ClientInterface;
use Buzz\Message\MessageInterface;
use Buzz\Message\RequestInterface;

/**
 * @author  Alexandru G.    <alex@gentle.ro>
 */
class OAuth2Listener implements ListenerInterface
{
    const ENDPOINT_ACCESS_TOKEN     = 'access_token';
    const ENDPOINT_AUTHORIZE        = 'authorize';

    /** @var array */
    protected static $config = array(
        'oauth_client_id'       => 'anon',
        'oauth_client_secret'   => 'anon',
        'token_type'            => 'bearer',
        'scopes'                => array()
    );

    /** @var ClientInterface */
    private $httpClient;

    public function __construct(array $config, ClientInterface $client = null)
    {
        self::$config       = array_merge(self::$config, $config);
        $this->httpClient   = (null !== $client) ? $client : new Client(
            array(
                'base_url'      => 'https://bitbucket.org/site',
                'api_version'   => 'oauth2',
                'api_versions'  => array('oauth2')
            )
        );
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'oauth2';
    }

    /**
     * {@inheritDoc}
     *
     * @throws ForbiddenAccessException
     * @throws \InvalidArgumentException
     */
    public function preSend(RequestInterface $request)
    {
        if (($oauth2Header = $request->getHeader('Authorization')) &&
            (strpos($oauth2Header, 'Bearer') !== false)
        ) {
            return;
        }

        if (false === array_key_exists('access_token', self::$config)) {
            try {
                $data = $this->getAccessToken();
                self::$config['token_type']     = $data['token_type'];
                self::$config['access_token']   = $data['access_token'];
            } catch (HttpResponseException $e) {
                throw new ForbiddenAccessException("Can't fetch access_token.", 0, $e);
            }
        }

        $request->addHeader(
            sprintf(
                'Authorization: %s %s',
                ucfirst(strtolower(self::$config['token_type'])),
                self::$config['access_token']
            )
        );
    }

    /**
     * {@inheritDoc}
     */
    public function postSend(RequestInterface $request, MessageInterface $response)
    {
    }

    /**
     * Fetch access token with a grant_type of client_credentials
     *
     * @access public
     * @return array
     *
     * throws \InvalidArgumentException
     * @throws HttpResponseException
     */
    protected function getAccessToken()
    {
        $response = $this->httpClient
            ->post(
                self::ENDPOINT_ACCESS_TOKEN,
                array(
                    'grant_type'    => 'client_credentials',
                    'client_id'     => self::$config['client_id'],
                    'client_secret' => self::$config['client_secret'],
                    'scope'         => implode(',', self::$config['scopes'])
                )
            )
        ;

        $data = json_decode($response->getContent(), true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            $ex = new HttpResponseException('[access_token] Invalid JSON: '. json_last_error_msg());
            $ex
                ->setResponse($this->httpClient->getLastResponse())
                ->setRequest($this->httpClient->getLastRequest())
            ;

            throw $ex;
        }

        if (false === array_key_exists('access_token', $data)) {
            throw new HttpResponseException('access_token is missing from response. '. $response->getContent());
        }

        return $data;
    }
}
