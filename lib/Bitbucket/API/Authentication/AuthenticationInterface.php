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
