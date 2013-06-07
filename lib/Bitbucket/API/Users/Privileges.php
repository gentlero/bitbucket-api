<?php

/*
 * This file is part of the bitbucket_api package.
 *
 * (c) Alexandru G. <alex@gentle.ro>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Bitbucket\API\Users;

use Bitbucket\API\Api;

/**
 * Privileges class
 *
 * Manage privilege settings for a team account.
 *
 * @author  Alexandru G.    <alex@gentle.ro>
 */
class Privileges extends Api
{
    /**
     * Get a list of privilege groups on a team account
     *
     * @access public
     * @param  string $account The team or individual account name.
     * @return mixed
     */
    public function team($account)
    {
        return $this->requestGet(
            sprintf('users/%s/privileges', $account)
        );
    }

    /**
     * Get the privileges associated with a group
     *
     * @access public
     * @param  string $account     The team or individual account name.
     * @param  string $group_owner The account that owns the group.
     * @param  string $group_slug  The group identifier.
     * @return mixed
     */
    public function group($account, $group_owner, $group_slug)
    {
        return $this->requestGet(
            sprintf('users/%s/privileges/%s/%s', $account, $group_owner, $group_slug)
        );
    }
}
