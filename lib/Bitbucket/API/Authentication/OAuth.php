<?php

/**
 * This file is part of the bitbucket-api package.
 *
 * (c) Alexandru G. <alex@gentle.ro>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Bitbucket\API\Authentication;

use Buzz\Message\RequestInterface;

/**
 * Build authorization header from previously signed OAuth parameters
 * and pass it to current request.
 *
 * @author  Alexandru G.    <alex@gentle.ro>
 */
class OAuth implements AuthenticationInterface
{
    /**
     * @var string
     */
    protected $authHeader;

    /**
     * @param string|array $params OAuth signed parameters
     */
    public function __construct($params)
    {
        $this->setAuthHeader($params);
    }

    /**
     * Get authorization header parameters
     *
     * @access public
     * @return string
     */
    public function getAuthHeader()
    {
        return $this->authHeader;
    }

    /**
     * Set authorization header parameters
     *
     * @access public
     * @param  string|array $params OAuth signed parameters
     * @return void
     */
    public function setAuthHeader($params)
    {
        if (is_array($params)) {
            $this->authHeader = $this->toHeader($params);
        } else {

            if (strpos($params, 'Authorization: ') !== false) {
                $params = str_replace('Authorization: ', '', $params);
            }

            $this->authHeader = $params;
        }
    }

    /**
     * Build authorization header from array
     *
     * @access public
     * @param  array  $params
     * @return string
     */
    protected function toHeader(array $params)
    {
        $out    = '';
        $last   = end($params);

        foreach ($params as $k => $v) {
            $out .= $k.'="'.$v.'"';

            if ($v != $last) {
                $out .= ',';
            }
        }

        return $out;
    }

    /**
     * {@inheritdoc}
     */
    public function authenticate(RequestInterface $request)
    {
        if (strpos($this->authHeader, 'OAuth') === false) {
            $this->authHeader = 'OAuth '.$this->authHeader;
        }

        $request->addHeader('Authorization: '.$this->authHeader);

        return $request;
    }
}
