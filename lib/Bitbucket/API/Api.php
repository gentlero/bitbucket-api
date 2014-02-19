<?php

/*
 * This file is part of the bitbucket-api package.
 *
 * (c) Alexandru G. <alex@gentle.ro>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Bitbucket\API;

use Buzz\Message\RequestInterface;
use Buzz\Client\ClientInterface as BuzzClientInterface;
use Bitbucket\API\Http\ClientInterface;
use Bitbucket\API\Http\Client;
use Buzz\Client\Curl;

/**
 * Api
 *
 * @author  Alexandru G.    <alex@gentle.ro>
 */
class Api
{
    /**
     * Api response codes.
     */
    const HTTP_RESPONSE_OK              = 200;
    const HTTP_RESPONSE_CREATED         = 201;
    const HTTP_RESPONSE_NO_CONTENT      = 204;
    const HTTP_RESPONSE_BAD_REQUEST     = 400;
    const HTTP_RESPONSE_UNAUTHORIZED    = 401;
    const HTTP_RESPONSE_FORBIDDEN       = 403;
    const HTTP_RESPONSE_NOT_FOUND       = 404;

    /**
     * Transport object
     * @var BuzzClientInterface
     */
    protected $client;

    /**
     * @var ClientInterface
     */
    protected $httpClient;

    /**
     * Authentication object
     * @var Authentication\AuthenticationInterface
     */
    protected $auth;

    /**
     * @param  BuzzClientInterface $client
     * @return self
     */
    public function __construct(BuzzClientInterface $client = null)
    {
        // @todo[1]: This exists for keeping BC. To be removed!
        $this->client       = (is_null($client)) ? new Curl : $client;
        $this->httpClient   = new Client(array(), $client);

        return $this;
    }

    /**
     * @access public
     * @return ClientInterface
     */
    public function getClient()
    {
        return $this->httpClient;
    }

    /**
     * @access public
     * @param  ClientInterface $client
     * @return $this
     */
    public function setClient(ClientInterface $client)
    {
        $this->httpClient = $client;

        return $this;
    }

    /**
     * Set API login credentials
     *
     * @access public
     * @param  Authentication\AuthenticationInterface $auth
     * @return void
     */
    public function setCredentials(Authentication\AuthenticationInterface $auth)
    {
        // keep BC
        if ($auth instanceof Authentication\Basic) {
            $this->getClient()->addListener(
                new Http\Listener\BasicAuthListener($auth->getUsername(), $auth->getPassword())
            );
        }

        $this->auth = $auth;
    }

    /**
     * Add authorization header
     *
     * @access public
     * @param  RequestInterface $request
     * @return RequestInterface
     */
    public function authorize(RequestInterface $request)
    {
        if (!is_null($this->auth)) {
            $request = $this->auth->authenticate($request);
        }

        return $request;
    }

    /**
     * Make an HTTP GET request to API
     *
     * @access public
     * @param  string       $endpoint API endpoint
     * @param  string|array $params   GET parameters
     * @param  array        $headers  HTTP headers
     * @return mixed
     */
    public function requestGet($endpoint, $params = array(), $headers = array())
    {
        return $this->getClient()->get($endpoint, $params, $headers);
    }

    /**
     * Make an HTTP POST request to API
     *
     * @access public
     * @param  string       $endpoint API endpoint
     * @param  string|array $params   POST parameters
     * @param  array        $headers  HTTP headers
     * @return mixed
     */
    public function requestPost($endpoint, $params = array(), $headers = array())
    {
        return $this->getClient()->post($endpoint, $params, $headers);
    }

    /**
     * Make an HTTP PUT request to API
     *
     * @access public
     * @param  string       $endpoint API endpoint
     * @param  string|array $params   POST parameters
     * @param  array        $headers  HTTP headers
     * @return mixed
     */
    public function requestPut($endpoint, $params = array(), $headers = array())
    {
        return $this->getClient()->put($endpoint, $params, $headers);
    }

    /**
     * Make a HTTP DELETE request to API
     *
     * @access public
     * @param  string       $endpoint API endpoint
     * @param  string|array $params   DELETE parameters
     * @param  array        $headers  HTTP headers
     * @return mixed
     */
    public function requestDelete($endpoint, $params = array(), $headers = array())
    {
        return $this->getClient()->delete($endpoint, $params, $headers);
    }

    /**
     * Create HTTP request
     *
     * @access protected
     * @param  string       $method   HTTP method
     * @param  string       $endpoint Api endpoint
     * @param  string|array $params   Request parameter(s)
     * @param  array        $headers  HTTP headers
     * @return mixed
     *
     * @throws \RuntimeException
     */
    protected function doRequest($method, $endpoint, $params, array $headers)
    {
        return $this->getClient()->request($endpoint, $params, $method, $headers);
    }

    /**
     * Set the preferred format for response
     *
     * @access public
     * @param  string $name Format name
     * @return self
     *
     * @throws \InvalidArgumentException
     */
    public function setFormat($name)
    {
        $this->getClient()->setResponseFormat($name);

        return $this;
    }

    /**
     * Get current format used for response
     *
     * @access public
     * @return string
     */
    public function getFormat()
    {
        return $this->getClient()->getResponseFormat();
    }

    /**
     * Process response received from API
     *
     * @access protected
     * @param  \Buzz\Message\MessageInterface $response
     * @return mixed
     *
     * @throws Authentication\Exception
     * @throws Exceptions\ForbiddenAccessException
     */
    protected function processResponse(\Buzz\Message\MessageInterface $response)
    {
        switch ($response->getStatusCode()) {
            case self::HTTP_RESPONSE_OK:
            case self::HTTP_RESPONSE_CREATED:
                return $response->getContent();
                break;

            case self::HTTP_RESPONSE_NO_CONTENT:
                return true;
                break;

            case self::HTTP_RESPONSE_BAD_REQUEST:
                return $response;

            case self::HTTP_RESPONSE_UNAUTHORIZED:
                throw new Authentication\Exception("Unauthorized: Authentication required");
                break;

            case self::HTTP_RESPONSE_FORBIDDEN:
                throw new Exceptions\ForbiddenAccessException("Not enough permissions.");
                break;

            case self::HTTP_RESPONSE_NOT_FOUND:
                return false;
                break;

            default:
                return $response;
                break;
        }
    }
}
