<?php

/**
 * This file is part of the bitbucket-api package.
 *
 * (c) Alexandru G. <alex@gentle.ro>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Bitbucket\API\Repositories\Issues;

use Bitbucket\API;

/**
 * @author  Alexandru G.    <alex@gentle.ro>
 */
class Milestones extends API\Api
{
    /**
     * Get a list of milestones
     *
     * Get a list of milestones associated with the issue tracker
     *
     * @access public
     * @param  string $account The team or individual account owning the repository.
     * @param  string $repo    The repository identifier.
     * @return mixed
     */
    public function all($account, $repo)
    {
        return $this->requestGet(
            sprintf('repositories/%s/%s/issues/milestones', $account, $repo)
        );
    }

    /**
     * Get an individual milestone
     *
     * @access public
     * @param  string $account     The team or individual account owning the repository.
     * @param  string $repo        The repository identifier.
     * @param  int    $milestoneID The milestone identifier.
     * @return mixed
     */
    public function get($account, $repo, $milestoneID)
    {
        return $this->requestGet(
            sprintf('repositories/%s/%s/issues/milestones/%d', $account, $repo, $milestoneID)
        );
    }

    /**
     * Add a new milestone
     *
     * @access public
     * @param  string $account The team or individual account owning the repository.
     * @param  string $repo    The repository identifier.
     * @param  string $name    The milestone name to create.
     * @return mixed
     */
    public function create($account, $repo, $name)
    {
        return $this->requestPost(
            sprintf('repositories/%s/%s/issues/milestones', $account, $repo),
            array('name' => $name)
        );
    }

    /**
     * Update an existing milestone
     *
     * @access public
     * @param  string $account     The team or individual account owning the repository.
     * @param  string $repo        The repository identifier.
     * @param  int    $milestoneID The milestone identifier.
     * @param  string $name        The milestone name to update.
     * @return mixed
     */
    public function update($account, $repo, $milestoneID, $name)
    {
        return $this->requestPut(
            sprintf('repositories/%s/%s/issues/milestones/%d', $account, $repo, $milestoneID),
            array('name' => $name)
        );
    }

    /**
     * Delete an existing milestone
     *
     * @access public
     * @param  string $account     The team or individual account owning the repository.
     * @param  string $repo        The repository identifier.
     * @param  int    $milestoneID The milestone identifier.
     * @return mixed
     */
    public function delete($account, $repo, $milestoneID)
    {
        return $this->requestDelete(
            sprintf('repositories/%s/%s/issues/milestones/%d', $account, $repo, $milestoneID)
        );
    }
}
