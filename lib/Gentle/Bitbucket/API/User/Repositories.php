<?php

/*
 * This file is part of the bitbucket_api package.
 *
 * (c) Alexandru G. <alex@gentle.ro>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gentle\Bitbucket\API\User;

use Gentle\Bitbucket\API;

/**
 * Repositories class
 *
 * [Class description]
 *
 * @author  Alexandru G.    <alex@gentle.ro>
 */
class Repositories extends API\Api
{
    /**
     * Get a list of repositories visible to an account
     *
     * @access public
     * @return mixed
     */
    public function get()
    {
        return $this->requestGet('user/repositories');
    }

    /**
     * Get a list of repositories the account is following
     *
     * @access public
     * @return mixed
     */
    public function overview()
    {
        return $this->requestGet('user/repositories/overview');
    }
}
