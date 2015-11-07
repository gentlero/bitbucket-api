<?php

/**
 * This file is part of the bitbucket-api package.
 *
 * (c) Alexandru G. <alex@gentle.ro>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Bitbucket\API\Http;

use Buzz\Client\ClientInterface as BuzzClientInterface;
use Buzz\Client\Curl;
use Buzz\Message\MessageInterface;
use Buzz\Message\RequestInterface;
use Buzz\Message\Request;
use Buzz\Message\Response;
use Bitbucket\API\Http\Listener\ListenerInterface;

/**
 * @author  Alexandru G.    <alex@gentle.ro>
 */
class Client extends ClientListener implements ClientInterface
{
    /**
     * @var array
     */
    protected $options = array(
        'base_url'      => 'https://api.bitbucket.org',
        'api_version'   => '1.0',
        'api_versions'  => array('1.0', '2.0'),     // supported versions
        'format'        => 'json',
        'formats'       => array('json', 'xml'),    // supported response formats
        'user_agent'    => 'bitbucket-api-php/0.7.1 (https://bitbucket.org/gentlero/bitbucket-api)',
        'timeout'       => 10,
        'verify_peer'   => false
    );

    /**
     * @var BuzzClientInterface
     */
    protected $client;

    /**
     * @var RequestInterface
     */
    private $lastRequest;

    /**
     * @var MessageInterface
     */
    private $lastResponse;

    /**
     * @var MessageInterface
     */
    protected $responseObj;

    /**
     * @var RequestInterface
     */
    protected $requestObj;

    public function __construct(array $options = array(), BuzzClientInterface $client = null)
    {
        $this->client   = (is_null($client)) ? new Curl : $client;
        $this->options  = array_merge($this->options, $options);

        $this->client->setTimeout($this->options['timeout']);
        $this->client->setVerifyPeer($this->options['verify_peer']);
    }

    /**
     * {@inheritDoc}
     */
    public function get($endpoint, $params = array(), $headers = array())
    {
        if (is_array($params) && count($params) > 0) {
            $endpoint   .= (strpos($endpoint, '?') === false ? '?' : '&').http_build_query($params, '', '&');
            $params     = array();
        }

        return $this->request($endpoint, $params, 'GET', $headers);
    }

    /**
     * {@inheritDoc}
     */
    public function post($endpoint, $params = array(), $headers = array())
    {
        return $this->request($endpoint, $params, 'POST', $headers);
    }

    /**
     * {@inheritDoc}
     */
    public function put($endpoint, $params = array(), $headers = array())
    {
        return $this->request($endpoint, $params, 'PUT', $headers);
    }

    /**
     * {@inheritDoc}
     */
    public function delete($endpoint, $params = array(), $headers = array())
    {
        return $this->request($endpoint, $params, 'DELETE', $headers);
    }

    /**
     * {@inheritDoc}
     */
    public function request($endpoint, $params = array(), $method = 'GET', array $headers = array())
    {
        $request = $this->createRequest($method, $endpoint);

        // add a default content-type if none was set
        if (in_array(strtoupper($method), array('POST', 'PUT')) && empty($headers['Content-Type'])) {
            $headers['Content-Type'] = 'application/x-www-form-urlencoded';
        }

        if (!empty($headers)) {
            $request->addHeaders($headers);
        }

        if (!empty($params)) {
            $request->setContent(is_array($params) ? http_build_query($params) : $params);
        }

        $response = is_object($this->responseObj) ? $this->responseObj : new Response;

        $this->executeListeners($request, 'preSend');

        $this->client->send($request, $response);

        $this->executeListeners($request, 'postSend', $response);

        $this->lastRequest  = $request;
        $this->lastResponse = $response;

        return $response;
    }

    /**
     * @access public
     * @return BuzzClientInterface
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * {@inheritDoc}
     */
    public function getResponseFormat()
    {
        return $this->options['format'];
    }

    /**
     * {@inheritDoc}
     */
    public function setResponseFormat($format)
    {
        if (!in_array($format, $this->options['formats'])) {
            throw new \InvalidArgumentException(sprintf('Unsupported response format %s', $format));
        }

        $this->options['format'] = $format;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getApiVersion()
    {
        return $this->options['api_version'];
    }

    /**
     * {@inheritDoc}
     */
    public function setApiVersion($version)
    {
        if (!in_array($version, $this->options['api_versions'])) {
            throw new \InvalidArgumentException(sprintf('Unsupported API version %s', $version));
        }

        $this->options['api_version'] = $version;

        return $this;
    }

    /**
     * Check if specified API version is the one currently in use
     *
     * @access public
     * @param  float $version
     * @return bool
     */
    public function isApiVersion($version)
    {
        return (abs($this->options['api_version'] - $version) < 0.00001);
    }

    /**
     * {@inheritDoc}
     */
    public function getApiBaseUrl()
    {
        return $this->options['base_url'].'/'.$this->getApiVersion();
    }

    /**
     * @access public
     * @return MessageInterface
     */
    public function getLastRequest()
    {
        return $this->lastRequest;
    }

    /**
     * @access public
     * @return RequestInterface
     */
    public function getLastResponse()
    {
        return $this->lastResponse;
    }

    /**
     * @access public
     * @param  MessageInterface $response
     * @return void
     */
    public function setResponse(MessageInterface $response)
    {
        $this->responseObj = $response;
    }

    /**
     * @access public
     * @param  RequestInterface $request
     * @return void
     */
    public function setRequest(RequestInterface $request)
    {
        $this->requestObj = $request;
    }

    /**
     * @access protected
     * @param  string           $method
     * @param  string           $url
     * @return RequestInterface
     */
    protected function createRequest($method, $url)
    {
        // do not set base URL if a full one was provided
        if (false === strpos($url, $this->getApiBaseUrl())) {
            $url = $this->getApiBaseUrl().'/'.$url;
        }

        // change the response format
        if (strpos($url, 'format=') === false) {
            $url .= (strpos($url, '?') === false ? '?' : '&').'format='.$this->getResponseFormat();
        }

        $request = is_object($this->requestObj) ? $this->requestObj : new Request();
        $request->setMethod($method);
        $request->addHeaders(array(
                'User-Agent' => $this->options['user_agent']
            ));
        $request->setProtocolVersion(1.1);
        $request->fromUrl($url);

        return $request;
    }

    /**
     * Execute all available listeners
     *
     * $when can be: preSend or postSend
     *
     * @access protected
     * @param RequestInterface $request
     * @param string           $when     When to execute the listener
     * @param MessageInterface $response
     */
    protected function executeListeners(RequestInterface $request, $when = 'preSend', MessageInterface $response = null)
    {
        $haveListeners  = count($this->listeners) > 0;

        if (!$haveListeners) {
            return;
        }

        $params = array($request);

        if (!is_null($response)) {
            $params[] = $response;
        }

        ksort($this->listeners, SORT_ASC);

        array_walk_recursive(
            $this->listeners,
            function ($class) use ($when, $params) {
                if ($class instanceof ListenerInterface) {
                    call_user_func_array(array($class, $when), $params);
                }
            }
        );
    }
}
