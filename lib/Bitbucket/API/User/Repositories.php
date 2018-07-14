<?php

/**
 * This file is part of the bitbucket-api package.
 *
 * (c) Alexandru G. <alex@gentle.ro>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Bitbucket\API\User;

use Bitbucket\API;
use Psr\Http\Message\ResponseInterface;

/**
 * Get the details of the repositories associated with
 * an individual or team account.
 *
 * @author  Alexandru G.    <alex@gentle.ro>
 */
class Repositories extends API\Api
{
    /**
     * Get a list of repositories visible to an account
     *
     * @access public
     * @return ResponseInterface
     */
    public function get()
    {
        return $this->requestGet('user/repositories');
    }

    /**
     * Get a list of repositories the account is following
     *
     * @access public
     * @return ResponseInterface
     */
    public function overview()
    {
        return $this->requestGet('user/repositories/overview');
    }

    /**
     * Get the list of repositories on the dashboard
     *
     * @access public
     * @return ResponseInterface
     */
    public function dashboard()
    {
        return $this->requestGet('user/repositories/dashboard');
    }
}
