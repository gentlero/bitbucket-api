<?php

/**
 * This file is part of the bitbucket-api package.
 *
 * (c) Alexandru G. <alex@gentle.ro>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Bitbucket\API\Repositories;

use Bitbucket\API;

/**
 * Provides functionality for adding, removing, and configuring brokers on your repositories
 *
 * @author  Alexandru G.    <alex@gentle.ro>
 */
class Services extends API\Api
{
    /**
     * Get a list of services on a repository
     *
     * @access public
     * @param  string $account The team or individual account owning the repository.
     * @param  string $repo    The repository identifier.
     * @return mixed
     */
    public function all($account, $repo)
    {
        return $this->requestGet(
            sprintf('repositories/%s/%s/services', $account, $repo)
        );
    }

    /**
     * Get a single service attached to your repository
     *
     * @access public
     * @param  string $account   The team or individual account owning the repository.
     * @param  string $repo      The repository identifier.
     * @param  int    $serviceID The service id.
     * @return mixed
     */
    public function get($account, $repo, $serviceID)
    {
        return $this->requestGet(
            sprintf('repositories/%s/%s/services/%d', $account, $repo, $serviceID)
        );
    }

    /**
     * Create a new service
     *
     * @access public
     * @param  string $account The team or individual account owning the repository.
     * @param  string $repo    The repository identifier.
     * @param  string $type    Service type
     * @param  array  $params  Additional service parameters
     * @return mixed
     */
    public function create($account, $repo, $type, array $params = array())
    {
        return $this->requestPost(
            sprintf('repositories/%s/%s/services', $account, $repo),
            array_merge(array('type' => $type), $params)
        );
    }

    /**
     * Update a service
     *
     * @access public
     * @param  string $account   The team or individual account owning the repository.
     * @param  string $repo      The repository identifier.
     * @param  string $serviceID The service id.
     * @param  array  $params    Service parameters
     * @return mixed
     */
    public function update($account, $repo, $serviceID, array $params)
    {
        return $this->requestPut(
            sprintf('repositories/%s/%s/services/%d', $account, $repo, $serviceID),
            $params
        );
    }

    /**
     * Delete a service
     *
     * @access public
     * @param  string $account   The team or individual account owning the repository.
     * @param  string $repo      The repository identifier.
     * @param  int    $serviceID The service id.
     * @return mixed
     */
    public function delete($account, $repo, $serviceID)
    {
        return $this->requestDelete(
            sprintf('repositories/%s/%s/services/%d', $account, $repo, $serviceID)
        );
    }
}
