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

/**
 * @author  Alexandru G.    <alex@gentle.ro>
 */
interface ClientInterface
{
    /**
     * Make an HTTP GET request to API
     *
     * @access public
     * @param  string       $endpoint API endpoint
     * @param  string|array $params   GET parameters
     * @param  array        $headers  HTTP headers
     * @return mixed
     */
    public function get($endpoint, $params, $headers = array());

    /**
     * Make an HTTP POST request to API
     *
     * @access public
     * @param  string       $endpoint API endpoint
     * @param  string|array $params   POST parameters
     * @param  array        $headers  HTTP headers
     * @return mixed
     */
    public function post($endpoint, $params, $headers = array());

    /**
     * Make an HTTP PUT request to API
     *
     * @access public
     * @param  string       $endpoint API endpoint
     * @param  string|array $params   Put parameters
     * @param  array        $headers  HTTP headers
     * @return mixed
     */
    public function put($endpoint, $params, $headers = array());

    /**
     * Make a HTTP DELETE request to API
     *
     * @access public
     * @param  string       $endpoint API endpoint
     * @param  string|array $params   DELETE parameters
     * @param  array        $headers  HTTP headers
     * @return mixed
     */
    public function delete($endpoint, $params, $headers = array());
}
