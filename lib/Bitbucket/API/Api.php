<?php
/**
 * This file is part of the bitbucket-api package.
 *
 * (c) Alexandru Guzinschi <alex@gentle.ro>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Bitbucket\API;

use Bitbucket\API\Http\Listener\ApiOneCollectionListener;
use Bitbucket\API\Http\Listener\NormalizeArrayListener;
use Buzz\Message\MessageInterface;
use Bitbucket\API\Http\ClientInterface;
use Bitbucket\API\Http\Client;

/**
 * @author Alexandru Guzinschi <alex@gentle.ro>
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
     * @var ClientInterface
     */
    protected $httpClient;

    /**
     * Authentication object
     * @var Authentication\AuthenticationInterface
     */
    protected $auth;

    /**
     * @param array           $options
     * @param ClientInterface $client
     */
    public function __construct(array $options = array(), ClientInterface $client = null)
    {
        $this->httpClient = (null !== $client) ? $client : new Client($options, $client);

        $this->httpClient->addListener(new NormalizeArrayListener());
        $this->httpClient->addListener(new ApiOneCollectionListener());
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
     * Make an HTTP GET request to API
     *
     * @access public
     * @param  string           $endpoint API endpoint
     * @param  string|array     $params   GET parameters
     * @param  array            $headers  HTTP headers
     * @return MessageInterface
     */
    public function requestGet($endpoint, $params = array(), $headers = array())
    {
        return $this->getClient()->get($endpoint, $params, $headers);
    }

    /**
     * Make an HTTP POST request to API
     *
     * @access public
     * @param  string           $endpoint API endpoint
     * @param  string|array     $params   POST parameters
     * @param  array            $headers  HTTP headers
     * @return MessageInterface
     */
    public function requestPost($endpoint, $params = array(), $headers = array())
    {
        return $this->getClient()->post($endpoint, $params, $headers);
    }

    /**
     * Make an HTTP PUT request to API
     *
     * @access public
     * @param  string           $endpoint API endpoint
     * @param  string|array     $params   POST parameters
     * @param  array            $headers  HTTP headers
     * @return MessageInterface
     */
    public function requestPut($endpoint, $params = array(), $headers = array())
    {
        return $this->getClient()->put($endpoint, $params, $headers);
    }

    /**
     * Make a HTTP DELETE request to API
     *
     * @access public
     * @param  string           $endpoint API endpoint
     * @param  string|array     $params   DELETE parameters
     * @param  array            $headers  HTTP headers
     * @return MessageInterface
     */
    public function requestDelete($endpoint, $params = array(), $headers = array())
    {
        return $this->getClient()->delete($endpoint, $params, $headers);
    }

    /**
     * Create HTTP request
     *
     * @access protected
     * @param  string           $method   HTTP method
     * @param  string           $endpoint Api endpoint
     * @param  string|array     $params   Request parameter(s)
     * @param  array            $headers  HTTP headers
     * @return MessageInterface
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
     * @param  string $name
     * @return Api
     *
     * @throws \InvalidArgumentException
     */
    public function api($name)
    {
        if (!is_string($name) || $name === '') {
            throw new \InvalidArgumentException('No child specified.');
        }

        /** @var Api $child */
        $class = '\\Bitbucket\\API\\'.$name;

        if (!class_exists($class)) {
            throw new \InvalidArgumentException(sprintf('No such child class [%s].', $name));
        }

        $child = new $class();
        $child->setClient($this->getClient());

        if ($this->getClient()->hasListeners()) {
            $child->getClient()->setListeners($this->getClient()->getListeners());
        }

        return $child;
    }

    /**
     * @access public
     * @return void
     */
    public function __clone()
    {
        // prevent reference to the same HTTP client.
        $this->setClient(clone $this->getClient());
    }

    /**
     * Convert JSON to array with error check
     *
     * @access protected
     * @param  string $body JSON data
     * @return array
     *
     * @throws \InvalidArgumentException
     */
    protected function decodeJSON($body)
    {
        $params = json_decode($body, true);

        if (!is_array($params) || (JSON_ERROR_NONE !== json_last_error())) {
            throw new \InvalidArgumentException('Invalid JSON data provided.');
        }

        return $params;
    }
}
