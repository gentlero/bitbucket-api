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
class Components extends API\Api
{
    /**
     * Get all components defined on a issue tracker
     *
     * @access public
     * @param  string $account The team or individual account owning the repository.
     * @param  string $repo    The repository identifier.
     * @return mixed
     */
    public function all($account, $repo)
    {
        return $this->requestGet(
            sprintf('repositories/%s/%s/issues/components', $account, $repo)
        );
    }

    /**
     * Get an individual component
     *
     * @access public
     * @param  string $account     The team or individual account owning the repository.
     * @param  string $repo        The repository identifier.
     * @param  int    $componentID The component identifier.
     * @return mixed
     */
    public function get($account, $repo, $componentID)
    {
        return $this->requestGet(
            sprintf('repositories/%s/%s/issues/components/%d', $account, $repo, $componentID)
        );
    }

    /**
     * Add a new component
     *
     * @access public
     * @param  string $account The team or individual account owning the repository.
     * @param  string $repo    The repository identifier.
     * @param  string $name    The component name to create.
     * @return mixed
     */
    public function create($account, $repo, $name)
    {
        return $this->requestPost(
            sprintf('repositories/%s/%s/issues/components', $account, $repo),
            array('name' => $name)
        );
    }

    /**
     * Update an existing component
     *
     * @access public
     * @param  string $account     The team or individual account owning the repository.
     * @param  string $repo        The repository identifier.
     * @param  int    $componentID The component identifier.
     * @param  string $name        The component name to update.
     * @return mixed
     */
    public function update($account, $repo, $componentID, $name)
    {
        return $this->requestPut(
            sprintf('repositories/%s/%s/issues/components/%d', $account, $repo, $componentID),
            array('name' => $name)
        );
    }

    /**
     * Delete an existing component
     *
     * @access public
     * @param  string $account     The team or individual account owning the repository.
     * @param  string $repo        The repository identifier.
     * @param  int    $componentID The component identifier.
     * @return mixed
     */
    public function delete($account, $repo, $componentID)
    {
        return $this->requestDelete(
            sprintf('repositories/%s/%s/issues/components/%d', $account, $repo, $componentID)
        );
    }
}
