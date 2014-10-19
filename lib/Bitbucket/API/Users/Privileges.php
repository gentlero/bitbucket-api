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
     * @param  string           $account The team or individual account name.
     * @return MessageInterface
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
     * @param  string           $account    The team or individual account name.
     * @param  string           $groupOwner The account that owns the group.
     * @param  string           $groupSlug  The group identifier.
     * @return MessageInterface
     */
    public function group($account, $groupOwner, $groupSlug)
    {
        return $this->requestGet(
            sprintf('users/%s/privileges/%s/%s', $account, $groupOwner, $groupSlug)
        );
    }

    /**
     * Updates a group's privileges on a team account
     *
     * @access public
     * @param  string           $account    The team or individual account name.
     * @param  string           $groupOwner The account that owns the group.
     * @param  string           $groupSlug  The group identifier.
     * @param  string           $privilege  Either admin or collaborator.
     * @return MessageInterface
     *
     * @throws \InvalidArgumentException
     */
    public function update($account, $groupOwner, $groupSlug, $privilege)
    {
        if (!in_array($privilege, array('admin', 'collaborator'))) {
            throw new \InvalidArgumentException("Invalid privilege provided.");
        }

        return $this->requestPut(
            sprintf('users/%s/privileges/%s/%s', $account, $groupOwner, $groupSlug),
            array('privileges' => $privilege)
        );
    }

    /**
     * Add a privilege to a group
     *
     * @access public
     * @param  string           $account    The team or individual account name.
     * @param  string           $groupOwner The account that owns the group.
     * @param  string           $groupSlug  The group identifier.
     * @param  string           $privilege  Either admin or collaborator.
     * @return MessageInterface
     *
     * @throws \InvalidArgumentException
     */
    public function create($account, $groupOwner, $groupSlug, $privilege)
    {
        if (!in_array($privilege, array('admin', 'collaborator'))) {
            throw new \InvalidArgumentException("Invalid privilege provided.");
        }

        return $this->requestPost(
            sprintf('users/%s/privileges/%s/%s', $account, $groupOwner, $groupSlug),
            array('privileges' => $privilege)
        );
    }

    /**
     * Delete a privilege group
     *
     * @access public
     * @param  string           $account    The team or individual account name.
     * @param  string           $groupOwner The account that owns the group.
     * @param  string           $groupSlug  The group identifier.
     * @return MessageInterface
     */
    public function delete($account, $groupOwner, $groupSlug)
    {
        return $this->requestDelete(
            sprintf('users/%s/privileges/%s/%s', $account, $groupOwner, $groupSlug)
        );
    }
}
