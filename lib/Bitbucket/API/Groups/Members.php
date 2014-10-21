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
use Buzz\Message\MessageInterface;

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
     * @param  string           $account The team or individual account owning the repository.
     * @param  string           $repo    The repository identifier.
     * @return MessageInterface
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
     * @param  string           $account    The team or individual account owning the repository.
     * @param  string           $groupSlug  The slug of the group.
     * @param  string           $memberName An individual account.
     * @return MessageInterface
     */
    public function add($account, $groupSlug, $memberName)
    {
        return $this->requestPut(
            sprintf('groups/%s/%s/members/%s', $account, $groupSlug, $memberName)
        );
    }

    /**
     * Delete a member from group.
     *
     * @access public
     * @param  string           $account    The team or individual account owning the repository.
     * @param  string           $groupSlug  The slug of the group.
     * @param  string           $memberName An individual account.
     * @return MessageInterface
     */
    public function delete($account, $groupSlug, $memberName)
    {
        return $this->requestDelete(
            sprintf('groups/%s/%s/members/%s', $account, $groupSlug, $memberName)
        );
    }
}
