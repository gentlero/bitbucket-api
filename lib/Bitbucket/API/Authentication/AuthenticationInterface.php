<?php

namespace Bitbucket\API\Authentication;

use Buzz\Message\RequestInterface;

interface AuthenticationInterface
{
    /**
     * Apply basic HTTP headers to request object
     *
     * @access public
     * @param  RequestInterface $request
     * @return RequestInterface
     */
    public function authenticate(RequestInterface $request);
}
