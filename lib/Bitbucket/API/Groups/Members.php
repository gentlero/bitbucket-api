<?php

/**
 * This file is part of the bitbucket-api package.
 *
 * (c) Alexandru G. <alex@gentle.ro>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Bitbucket\API\Groups;

use Bitbucket\API;

/**
 * Manage group members.
 *
 * @author  Alexandru G.    <alex@gentle.ro>
 */
class Members extends API\Api
{
    /**
     * Get the group members
     *
     * @access public
     * @param  string $account The team or individual account owning the repository.
     * @param  string $repo    The repository identifier.
     * @return mixed
     */
    public function all($account, $repo)
    {
        return $this->requestGet(
            sprintf('groups/%s/%s/members', $account, $repo)
        );
    }

    /**
     * Add new member into a group.
     *
     * @access public
     * @param  string $account     The team or individual account owning the repository.
     * @param  string $group_slug  The slug of the group.
     * @param  string $member_name An individual account.
     * @return mixed
     */
    public function add($account, $group_slug, $member_name)
    {
        return $this->requestPut(
            sprintf('groups/%s/%s/members/%s', $account, $group_slug, $member_name)
        );
    }

    /**
     * Delete a member from group.
     *
     * @access public
     * @param  string $account     The team or individual account owning the repository.
     * @param  string $group_slug  The slug of the group.
     * @param  string $member_name An individual account.
     * @return mixed
     */
    public function delete($account, $group_slug, $member_name)
    {
        return $this->requestDelete(
            sprintf('groups/%s/%s/members/%s', $account, $group_slug, $member_name)
        );
    }
}
