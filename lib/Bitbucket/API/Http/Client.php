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

/**
 * @author  Alexandru G.    <alex@gentle.ro>
 */
class Client implements ClientInterface
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
        'user_agent'    => 'bitbucket-api-php/0.1.2 (https://bitbucket.org/gentlero/bitbucket-api)',
    );

    /**
     * @var BuzzClientInterface
     */
    protected $client;

    public function __construct(array $options = array(), BuzzClientInterface $client = null)
    {
        $this->client = (is_null($client)) ? new Curl : $client;
    }

    /**
     * {@inheritDoc}
     */
    public function get($endpoint, $params = array(), $headers = array())
    {
        if (is_array($params) AND count($params) > 0) {
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
     * Make a HTTP request
     *
     * @access public
     * @param  string           $endpoint
     * @param  string|array     $params
     * @param  string           $method
     * @param  array            $headers
     * @return MessageInterface
     */
    public function request($endpoint, array $params = array(), $method, array $headers = array())
    {
        // do not set base URL if a full one was provided
        if (false === strpos($endpoint, $this->getApiBaseUrl())) {
            $endpoint = $this->getApiBaseUrl().'/'.$endpoint;
        }

        // change the response format
        $endpoint .= (strpos($endpoint, '?') === false ? '?' : '&').'format='.$this->getResponseFormat();

        $request = $this->createRequest($method, $endpoint);

        if (!empty($headers)) {
            $request->addHeaders($headers);
        }

        if (!empty($params)) {
            $request->setContent(is_array($params) ? http_build_query($params) : $params);
        }

        $response       = new Response;

        $this->client->send($request, $response);

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
     * @access public
     * @return string
     */
    public function getResponseFormat()
    {
        return $this->options['format'];
    }

    /**
     * @access public
     * @param  string $format
     * @return $this
     *
     * @throws \InvalidArgumentException
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
     * Get API version currently used
     *
     * @access public
     * @return mixed
     */
    public function getApiVersion()
    {
        return $this->options['api_version'];
    }

    /**
     * Change used API version for next request
     *
     * @access public
     * @param  float $version
     * @return $this
     *
     * @throws \InvalidArgumentException
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
     * @return string
     */
    public function getApiBaseUrl()
    {
        return $this->options['base_url'].'/'.$this->getApiVersion();
    }

    /**
     * @access protected
     * @param  string           $method
     * @param  string           $url
     * @return RequestInterface
     */
    protected function createRequest($method, $url)
    {
        $request = new Request($method);
        $request->addHeaders(array(
                'User-Agent' => $this->options['user_agent']
            ));
        $request->setProtocolVersion(1.1);
        $request->fromUrl($url);

        return $request;
    }
}
