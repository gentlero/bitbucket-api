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

use Buzz\Message\MessageInterface;
use Bitbucket\API\Http\Listener\ListenerInterface;

/**
 * @author  Alexandru G.    <alex@gentle.ro>
 */
interface ClientInterface
{
    /**
     * Make an HTTP GET request to API
     *
     * @access public
     * @param  string           $endpoint API endpoint
     * @param  string|array     $params   GET parameters
     * @param  array            $headers  HTTP headers
     * @return MessageInterface
     */
    public function get($endpoint, $params = array(), $headers = array());

    /**
     * Make an HTTP POST request to API
     *
     * @access public
     * @param  string           $endpoint API endpoint
     * @param  string|array     $params   POST parameters
     * @param  array            $headers  HTTP headers
     * @return MessageInterface
     */
    public function post($endpoint, $params = array(), $headers = array());

    /**
     * Make an HTTP PUT request to API
     *
     * @access public
     * @param  string           $endpoint API endpoint
     * @param  string|array     $params   Put parameters
     * @param  array            $headers  HTTP headers
     * @return MessageInterface
     */
    public function put($endpoint, $params = array(), $headers = array());

    /**
     * Make a HTTP DELETE request to API
     *
     * @access public
     * @param  string           $endpoint API endpoint
     * @param  string|array     $params   DELETE parameters
     * @param  array            $headers  HTTP headers
     * @return MessageInterface
     */
    public function delete($endpoint, $params = array(), $headers = array());

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
    public function request($endpoint, $params = array(), $method = 'GET', array $headers = array());

    /**
     * Get response format for next request
     *
     * @access public
     * @return string
     */
    public function getResponseFormat();

    /**
     * Set response format for next request
     *
     * Supported formats: xml, json
     *
     * @access public
     * @param  string $format
     * @return string
     *
     * @throws \InvalidArgumentException If invalid response format is provided
     */
    public function setResponseFormat($format);

    /**
     * Get API version currently used
     *
     * @access public
     * @return mixed
     */
    public function getApiVersion();

    /**
     * Change used API version for next request
     *
     * Supported versions: 1.0, 2.0
     *
     * @access public
     * @param  float $version
     * @return $this
     *
     * @throws \InvalidArgumentException If invalid API version is provided
     */
    public function setApiVersion($version);

    /**
     * Construct API base URL based on current API version
     *
     * @access public
     * @return string
     */
    public function getApiBaseUrl();

    /**
     * @access public
     * @param  ListenerInterface $listener
     * @return $this
     */
    public function addListener(ListenerInterface $listener);

    /**
     * @access public
     * @param  ListenerInterface|string $name
     * @return $this
     */
    public function delListener($name);

    /**
     * Get listener interface
     *
     * @param  string            $name
     * @return ListenerInterface
     *
     * @throws \InvalidArgumentException
     */
    public function getListener($name);

    /**
     * Check if a listener exists
     *
     * @access public
     * @param  string $name
     * @return bool
     */
    public function isListener($name);
}
