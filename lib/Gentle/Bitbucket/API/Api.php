<?php

/*
 * This file is part of the bitbucket-api package.
 *
 * (c) Alexandru G. <alex@gentle.ro>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gentle\Bitbucket\API;

use Buzz\Message;
use Buzz\Client;
use Gentle\Bitbucket;

/**
 * Api
 *
 * @author  Alexandru G.    <alex@gentle.ro>
 */
class Api
{
    const API_URL = 'https://api.bitbucket.org/1.0';

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
     * Available API response formats.
     * @var array
     */
    private $formats = array(
        'json', 'yaml', 'xml'
    );

    /**
     * Default format for responses
     * @var string
     */
    private $format = 'json';

    /**
     * Transport object
     * @var Client\ClientInterface
     */
    protected $client;

    /**
     * Authentification object
     * @var Authentication\AuthenticationInterface
     */
    protected $auth;

    /**
     * @param  Client\ClientInterface $client
     * @return self
     */
    public function __construct(Client\ClientInterface $client = null)
    {
        $this->client = (is_null($client)) ? new Client\Curl : $client;

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
        $this->auth = $auth;
    }

    /**
     * Add authorization header
     *
     * @access public
     * @param  Message\RequestInterface $request
     * @return Message\RequestInterface
     */
    public function authorize(Message\RequestInterface $request)
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
     * @param  string $endpoint API endpoint
     * @param  array  $params   GET parameters
     * @param  array  $headers  HTTP headers
     * @return mixed
     */
    public function requestGet($endpoint, $params = array(), $headers = array())
    {
        return $this->doRequest('GET', $endpoint, $params, $headers);
    }

    /**
     * Make an HTTP POST request to API
     *
     * @access public
     * @param  string $endpoint API endpoint
     * @param  array  $params   POST parameters
     * @param  array  $headers  HTTP headers
     * @return mixed
     */
    public function requestPost($endpoint, $params = array(), $headers = array())
    {
        return $this->doRequest('POST', $endpoint, $params, $headers);
    }

    /**
     * Make an HTTP PUT request to API
     *
     * @access public
     * @param  string $endpoint API endpoint
     * @param  array  $params   POST parameters
     * @param  array  $headers  HTTP headers
     * @return mixed
     */
    public function requestPut($endpoint, $params = array(), $headers = array())
    {
        return $this->doRequest('PUT', $endpoint, $params, $headers);
    }

    /**
     * Make a HTTP DELETE request to API
     *
     * @access public
     * @param  string $endpoint API endpoint
     * @param  array  $params   DELETE parameters
     * @param  array  $headers  HTTP headers
     * @return mixed
     */
    public function requestDelete($endpoint, $params = array(), $headers = array())
    {
        return $this->doRequest('DELETE', $endpoint, $params, $headers);
    }

    /**
     * Create HTTP request
     *
     * @access protected
     * @param  string $method   HTTP method
     * @param  string $endpoint Api endpoint
     * @param  array  $params   Request parameters
     * @param  array  $headers  HTTP headers
     * @return mixed
     *
     * @throws \RuntimeException
     */
    protected function doRequest($method, $endpoint, array $params, array $headers)
    {
        $request    = new Message\Request;
        $response   = new Message\Response;

        if (strtoupper($method) != 'POST') {
            $params['format'] = $this->format;
        }

        $request->setMethod($method);
        $request->setProtocolVersion(1.1);
        $request->addHeaders($headers);

        $this->authorize($request);

        if (strtoupper($method) == 'GET') {
            $request->fromUrl(self::API_URL.'/'.urlencode($endpoint).'?'. http_build_query($params));
        } else {
            $request->fromUrl(self::API_URL.'/'.urlencode($endpoint));
            $request->setContent(http_build_query($params));
        }

        $this->client->send($request, $response);

        return $this->processResponse($response);
    }

    /**
     * Process response received from API
     *
     * @access protected
     * @param  Message\MessageInterface $response
     * @return mixed
     *
     * @throws Authentication\Exception
     * @throws ForbiddenAccessException
     */
    protected function processResponse(Message\MessageInterface $response)
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
                throw new ForbiddenAccessException("Not enough permissions.");
                break;

            case self::HTTP_RESPONSE_NOT_FOUND:
                return false;
                break;

            default:
                return $response;
                break;
        }
    }

    /**
     * Set the prefered format for response
     *
     * @access public
     * @param  string $name Format name
     * @return self
     *
     * @throws \InvalidArgumentException
     */
    public function setFormat($name)
    {
        if (!in_array($name, $this->formats)) {
            throw new \InvalidArgumentException(sprintf('%s is not a valid format.', $name));
        }

        $this->format = $name;

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
        return $this->format;
    }
}

// @todo: poate sa mut exceptia asta in User namespace ?
class ForbiddenAccessException extends \Exception { }
