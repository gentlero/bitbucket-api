<?php

/**
 * This file is part of the bitbucket-api package.
 *
 * (c) Alexandru G. <alex@gentle.ro>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Bitbucket\API;

/**
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

    /**
     * Get a list of user privileges
     *
     * @access public
     * @return mixed
     */
    public function privileges()
    {
        return $this->requestGet('user/privileges');
    }

    /**
     * Get a list of repositories an account follows
     *
     * @access public
     * @return mixed
     */
    public function follows()
    {
        return $this->requestGet('user/follows');
    }

    /**
     * Get repositories
     *
     * @access public
     * @return User\Repositories
     * @codeCoverageIgnore
     */
    public function repositories()
    {
        return $this->childFactory('User\\Repositories');
    }
}
