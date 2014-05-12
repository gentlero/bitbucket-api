<?php

/**
 * This file is part of the bitbucket-api package.
 *
 * (c) Alexandru G. <alex@gentle.ro>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Bitbucket\API\Users;

use Bitbucket\API\Api;

/**
 * This resource returns a user structure and the repositories array associated
 * with an existing account.
 *
 * @author  Alexandru G.    <alex@gentle.ro>
 */
class Account extends Api
{
    /**
     * Get the account profile
     *
     * @access public
     * @param  string $account The name of an individual or team account, or validated email address.
     * @return mixed
     */
    public function profile($account)
    {
        return $this->requestGet(
            sprintf('users/%s', $account)
        );
    }

    /**
     * Get the account plan
     *
     * Gets the number of users counted against an account's plan.
     *
     * @access public
     * @param  string $account The name of an individual or team account, or validated email address.
     * @return mixed
     */
    public function plan($account)
    {
        return $this->requestGet(
            sprintf('users/%s/plan', $account)
        );
    }

    /**
     * Get the followers
     *
     * Gets a count and the list of accounts following an account.
     *
     * @access public
     * @param  string $account The name of an individual or team account, or validated email address.
     * @return mixed
     */
    public function followers($account)
    {
        return $this->requestGet(
            sprintf('users/%s/followers', $account)
        );
    }

    /**
     * Get the events
     *
     * Gets a count and the list of events associated with an account.
     *
     * @access public
     * @param  string $account The name of an individual or team account, or validated email address.
     * @return mixed
     */
    public function events($account)
    {
        return $this->requestGet(
            sprintf('users/%s/events', $account)
        );
    }
}
