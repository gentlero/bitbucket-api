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
use Buzz\Message\MessageInterface;

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
     * @param  string           $account The name of an individual or team account.
     * @return MessageInterface
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
     * @param  string           $account The name of an individual or team account.
     * @param  string           $email   The email address to get.
     * @return MessageInterface
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
     * @param  string           $account    The name of an individual or team account.
     * @param  string           $groupOwner The name of an individual or team account that owns the group.
     * @param  string           $groupSlug  An identifier for the group.
     * @param  string           $email      Name of the email address
     * @return MessageInterface
     */
    public function group($account, $groupOwner, $groupSlug, $email)
    {
        return $this->requestGet(
            sprintf('users/%s/invitations/%s/%s/%s', $account, $email, $groupOwner, $groupSlug)
        );
    }

    /**
     * Issues an invitation to the specified account group.
     *
     * An invitation is a request sent to an external email address to participate one or more of an account's groups.
     *
     * @access public
     * @param  string           $account    The name of an individual or team account.
     * @param  string           $groupOwner The name of an individual or team account that owns the group.
     * @param  string           $groupSlug  An identifier for the group.
     * @param  string           $email      Name of the email address
     * @return MessageInterface
     */
    public function create($account, $groupOwner, $groupSlug, $email)
    {
        return $this->requestPut(
            sprintf('users/%s/invitations/%s/%s/%s', $account, $email, $groupOwner, $groupSlug)
        );
    }

    /**
     * Delete pending invitations by email address
     *
     * Deletes any pending invitations on a team or individual account for a particular email address.
     *
     * @access public
     * @param  string           $account The name of an individual or team account.
     * @param  string           $email   Name of the email address to delete.
     * @return MessageInterface
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
     * @param  string           $account    The name of an individual or team account.
     * @param  string           $groupOwner The name of an individual or team account that owns the group.
     * @param  string           $groupSlug  An identifier for the group.
     * @param  string           $email      Name of the email address to delete.
     * @return MessageInterface
     */
    public function deleteByGroup($account, $groupOwner, $groupSlug, $email)
    {
        return $this->requestDelete(
            sprintf('users/%s/invitations/%s/%s/%s', $account, $email, $groupOwner, $groupSlug)
        );
    }
}
