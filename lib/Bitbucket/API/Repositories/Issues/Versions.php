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
class Versions extends API\Api
{
    /**
     * Get a list of versions
     *
     * Get a list of versions associated with the issue tracker
     *
     * @access public
     * @param  string $account The team or individual account owning the repository.
     * @param  string $repo    The repository identifier.
     * @return mixed
     */
    public function all($account, $repo)
    {
        return $this->requestGet(
            sprintf('repositories/%s/%s/issues/versions', $account, $repo)
        );
    }

    /**
     * Get an individual version
     *
     * @access public
     * @param  string $account   The team or individual account owning the repository.
     * @param  string $repo      The repository identifier.
     * @param  int    $versionID The version identifier.
     * @return mixed
     */
    public function get($account, $repo, $versionID)
    {
        return $this->requestGet(
            sprintf('repositories/%s/%s/issues/versions/%d', $account, $repo, $versionID)
        );
    }

    /**
     * Add a new version
     *
     * @access public
     * @param  string $account The team or individual account owning the repository.
     * @param  string $repo    The repository identifier.
     * @param  string $name    The version name to create.
     * @return mixed
     */
    public function create($account, $repo, $name)
    {
        return $this->requestPost(
            sprintf('repositories/%s/%s/issues/versions', $account, $repo),
            array('name' => $name)
        );
    }

    /**
     * Update an existing version
     *
     * @access public
     * @param  string $account   The team or individual account owning the repository.
     * @param  string $repo      The repository identifier.
     * @param  int    $versionID The version identifier.
     * @param  string $name      The version name to update.
     * @return mixed
     */
    public function update($account, $repo, $versionID, $name)
    {
        return $this->requestPut(
            sprintf('repositories/%s/%s/issues/versions/%d', $account, $repo, $versionID),
            array('name' => $name)
        );
    }

    /**
     * Delete an existing version
     *
     * @access public
     * @param  string $account   The team or individual account owning the repository.
     * @param  string $repo      The repository identifier.
     * @param  int    $versionID The version identifier.
     * @return mixed
     */
    public function delete($account, $repo, $versionID)
    {
        return $this->requestDelete(
            sprintf('repositories/%s/%s/issues/versions/%d', $account, $repo, $versionID)
        );
    }
}
