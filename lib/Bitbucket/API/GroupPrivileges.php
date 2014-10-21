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

use Buzz\Message\MessageInterface;

/**
 * Manages a group's repository permissions.
 *
 * @author  Alexandru G.    <alex@gentle.ro>
 */
class GroupPrivileges extends Api
{
    /**
     * Get a list of privileged groups
     *
     * Gets all the groups granted access to an account's repositories.
     *
     * @access public
     * @param  string           $account The team or individual account owning the repository.
     * @return MessageInterface
     */
    public function groups($account)
    {
        return $this->requestGet(
            sprintf('group-privileges/%s/', $account)
        );
    }

    /**
     * Get a list of privileged groups for a repository
     *
     * Get a list of the privilege groups for a specific repository.
     *
     * @access public
     * @param  string           $account The team or individual account owning the repository.
     * @param  string           $repo    A repository belonging to the account.
     * @return MessageInterface
     */
    public function repository($account, $repo)
    {
        return $this->requestGet(
            sprintf('group-privileges/%s/%s', $account, $repo)
        );
    }

    /**
     * Get a group on a repository
     *
     * Gets the privileges of a group on a repository.
     *
     * @access public
     * @param  string           $account    The team or individual account owning the repository.
     * @param  string           $repo       A repository belonging to the account.
     * @param  string           $groupOwner The account that owns the group.
     * @param  string           $groupSlug  The group slug.
     * @return MessageInterface
     */
    public function group($account, $repo, $groupOwner, $groupSlug)
    {
        return $this->requestGet(
            sprintf('group-privileges/%s/%s/%s/%s', $account, $repo, $groupOwner, $groupSlug)
        );
    }

    /**
     * Get a list of repositories with a specific privilege group
     *
     * Get a list of the repositories on which a particular privilege group appears.
     *
     * @access public
     * @param  string           $account    The team or individual account owning the repository.
     * @param  string           $groupOwner The account that owns the group.
     * @param  string           $groupSlug  The group slug.
     * @return MessageInterface
     */
    public function repositories($account, $groupOwner, $groupSlug)
    {
        return $this->requestGet(
            sprintf('group-privileges/%s/%s/%s', $account, $groupOwner, $groupSlug)
        );
    }

    /**
     *
     * Grant group privileges on a repository.
     *
     * @access public
     * @param  string           $account    The team or individual account owning the repository.
     * @param  string           $repo       The repository to grant privileges on.
     * @param  string           $groupOwner The account that owns the group.
     * @param  string           $groupSlug  The group slug.
     * @param  string           $privilege  A privilege value
     * @return MessageInterface
     *
     * @throws \InvalidArgumentException
     */
    public function grant($account, $repo, $groupOwner, $groupSlug, $privilege)
    {
        if (!in_array($privilege, array('read', 'write', 'admin'))) {
            throw new \InvalidArgumentException("Invalid privilege provided.");
        }

        return $this->requestPut(
            sprintf('group-privileges/%s/%s/%s/%s', $account, $repo, $groupOwner, $groupSlug),
            $privilege
        );
    }

    /**
     * Delete group privileges from a repository
     *
     * @access public
     * @param  string           $account    The team or individual account.
     * @param  string           $repo       The repository to remove privileges from.
     * @param  string           $groupOwner The account that owns the group.
     * @param  string           $groupSlug  The group slug.
     * @return MessageInterface
     */
    public function delete($account, $repo, $groupOwner, $groupSlug)
    {
        return $this->requestDelete(
            sprintf('group-privileges/%s/%s/%s/%s', $account, $repo, $groupOwner, $groupSlug)
        );
    }
}
