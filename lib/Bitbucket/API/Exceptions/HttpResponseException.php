<?php

/**
 * This file is part of the bitbucket-api package.
 *
 * (c) Alexandru G. <alex@gentle.ro>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Bitbucket\API\Exceptions;

use Buzz\Message\MessageInterface;
use Buzz\Message\RequestInterface;

/**
 * @author  Alexandru G.    <alex@gentle.ro>
 */
class HttpResponseException extends \Exception
{
    /** @var MessageInterface */
    private $response;

    /** @var RequestInterface */
    private $request;

    /**
     * @access public
     * @return RequestInterface
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @access public
     * @param  RequestInterface $request
     * @return $this
     */
    public function setRequest($request)
    {
        $this->request = $request;

        return $this;
    }

    /**
     * @access public
     * @return MessageInterface
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @access public
     * @param  MessageInterface $response
     * @return $this
     */
    public function setResponse($response)
    {
        $this->response = $response;

        return $this;
    }
}
