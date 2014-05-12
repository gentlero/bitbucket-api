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
 * An invitation is a request sent to an external email address to participate
 * one or more of an account's groups.
 *
 * @author  Alexandru G.    <alex@gentle.ro>
 */
class Invitations extends Api
{
    /**
     * Get a list of pending invitations
     *
     * @access public
     * @param  string $account The name of an individual or team account.
     * @return mixed
     */
    public function all($account)
    {
        return $this->requestGet(
            sprintf('users/%s/invitations', $account)
        );
    }

    /**
     * Get pending invitations for a particular email address
     *
     * Gets any pending invitations on a team or individual account for a particular email address.
     *
     * @access public
     * @param  string $account The name of an individual or team account.
     * @param  string $email   The email address to get.
     * @return mixed
     */
    public function email($account, $email)
    {
        return $this->requestGet(
            sprintf('users/%s/invitations/%s', $account, $email)
        );
    }

    /**
     * Get a pending invitation for group membership
     *
     * @access public
     * @param  string $account     The name of an individual or team account.
     * @param  string $group_owner The name of an individual or team account that owns the group.
     * @param  string $group_slug  An identifier for the group.
     * @param  string $email       Name of the email address
     * @return mixed
     */
    public function group($account, $group_owner, $group_slug, $email)
    {
        return $this->requestGet(
            sprintf('users/%s/invitations/%s/%s/%s', $account, $email, $group_owner, $group_slug)
        );
    }

    /**
     * Issues an invitation to the specified account group.
     *
     * An invitation is a request sent to an external email address to participate one or more of an account's groups.
     *
     * @access public
     * @param  string $account     The name of an individual or team account.
     * @param  string $group_owner The name of an individual or team account that owns the group.
     * @param  string $group_slug  An identifier for the group.
     * @param  string $email       Name of the email address
     * @return mixed
     */
    public function create($account, $group_owner, $group_slug, $email)
    {
        return $this->requestPut(
            sprintf('users/%s/invitations/%s/%s/%s', $account, $email, $group_owner, $group_slug)
        );
    }

    /**
     * Delete pending invitations by email address
     *
     * Deletes any pending invitations on a team or individual account for a particular email address.
     *
     * @access public
     * @param  string $account The name of an individual or team account.
     * @param  string $email   Name of the email address to delete.
     * @return mixed
     */
    public function deleteByEmail($account, $email)
    {
        return $this->requestDelete(
            sprintf('users/%s/invitations/%s', $account, $email)
        );
    }

    /**
     * Delete pending invitations by group
     *
     * Deletes a pending invitation for a particular email on account's group.
     *
     * @access public
     * @param  string $account     The name of an individual or team account.
     * @param  string $group_owner The name of an individual or team account that owns the group.
     * @param  string $group_slug  An identifier for the group.
     * @param  string $email       Name of the email address to delete.
     * @return mixed
     */
    public function deleteByGroup($account, $group_owner, $group_slug, $email)
    {
        return $this->requestDelete(
            sprintf('users/%s/invitations/%s/%s/%s', $account, $email, $group_owner, $group_slug)
        );
    }
}
