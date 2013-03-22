<?php

/*
 * This file is part of the bitbucket_api package.
 *
 * (c) Alexandru G. <alex@gentle.ro>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gentle\Bitbucket\API;

/**
 * User class
 *
 * Manages the currently authenticated account profile.
 *
 * @author  Alexandru G.    <alex@gentle.ro>
 */
class User extends Api
{
    /**
     * Get user profile
     *
     * @access public
     * @return mixed
     */
    public function get()
    {
        return $this->requestGet('user/');
    }

    /**
     * Update user
     *
     * @access public
     * @param  array $options Filed->value pair of account settings
     * @return mixed
     *
     * @see https://confluence.atlassian.com/display/BITBUCKET/user+Endpoint#userEndpoint-Updateauser
     */
    public function update(array $options)
    {
        return $this->requestPut('user/', $options);
    }
}
