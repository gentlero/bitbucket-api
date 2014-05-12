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
 * Manages a group's repository permissions.
 *
 * @author  Alexandru G.    <alex@gentle.ro>
 */
class GroupPrivileges extends Api
{
    /**
     * Get a list of privileged groups
     *
     * Gets an array of all the groups granted access to an account's repositories.
     *
     * @access public
     * @param  string $account The team or individual account owning the repository.
     * @return mixed
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
     * @param  string $account The team or individual account owning the repository.
     * @param  string $repo    A repository belonging to the account.
     * @return mixed
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
     * @param  string $account     The team or individual account owning the repository.
     * @param  string $repo        A repository belonging to the account.
     * @param  string $group_owner The account that owns the group.
     * @param  string $group_slug  The group slug.
     * @return mixed
     */
    public function group($account, $repo, $group_owner, $group_slug)
    {
        return $this->requestGet(
            sprintf('group-privileges/%s/%s/%s/%s', $account, $repo, $group_owner, $group_slug)
        );
    }

    /**
     * Get a list of repositories with a specific privilege group
     *
     * Get a list of the repositories on which a particular privilege group appears.
     *
     * @access public
     * @param  string $account     The team or individual account owning the repository.
     * @param  string $group_owner The account that owns the group.
     * @param  string $group_slug  The group slug.
     * @return mixed
     */
    public function repositories($account, $group_owner, $group_slug)
    {
        return $this->requestGet(
            sprintf('group-privileges/%s/%s/%s', $account, $group_owner, $group_slug)
        );
    }

    /**
     *
     * Grant group privileges on a repository.
     *
     * @access public
     * @param  string                    $account     The team or individual account owning the repository.
     * @param  string                    $repo        The repository to grant privileges on.
     * @param  string                    $group_owner The account that owns the group.
     * @param  string                    $group_slug  The group slug.
     * @param  string                    $privilege   A privilege value
     * @return mixed
     * @throws \InvalidArgumentException
     */
    public function grant($account, $repo, $group_owner, $group_slug, $privilege)
    {
        if (!in_array($privilege, array('read', 'write', 'admin'))) {
            throw new \InvalidArgumentException("Invalid privilege provided.");
        }

        return $this->requestPut(
            sprintf('group-privileges/%s/%s/%s/%s', $account, $repo, $group_owner, $group_slug),
            $privilege
        );
    }

    /**
     * Delete group privileges from a repository
     *
     * @access public
     * @param  string $account     The team or individual account.
     * @param  string $repo        The repository to remove privileges from.
     * @param  string $group_owner The account that owns the group.
     * @param  string $group_slug  The group slug.
     * @return mixed
     */
    public function delete($account, $repo, $group_owner, $group_slug)
    {
        return $this->requestDelete(
            sprintf('group-privileges/%s/%s/%s/%s', $account, $repo, $group_owner, $group_slug)
        );
    }
}
