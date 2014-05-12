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
 * Manage changesets resources on a repository.
 *
 * @author  Alexandru G.    <alex@gentle.ro>
 */
class Changesets extends API\Api
{
    /**
     * Get a list of changesets
     *
     * @access public
     * @param  string $account The team or individual account owning the repo.
     * @param  string $repo    The repository identifier.
     * @param  string $start   A hash value representing the earliest node to start with.
     * @param  int    $limit   How many changesets to return
     * @return mixed
     */
    public function all($account, $repo, $start = null, $limit = 15)
    {
        return $this->requestGet(
            sprintf('repositories/%s/%s/changesets', $account, $repo, $start, $limit),
            array(
                'start' => $start,
                'limit' => $limit
            )
        );
    }

    /**
     * Get an individual changeset
     *
     * @access public
     * @param  string $account The team or individual account owning the repo.
     * @param  string $repo    The repository identifier.
     * @param  string $node    The raw_node changeset identifier.
     * @return mixed
     */
    public function get($account, $repo, $node)
    {
        return $this->requestGet(
            sprintf('repositories/%s/%s/changesets/%s', $account, $repo, $node)
        );
    }

    /**
     * Get statistics associated with an individual changeset
     *
     * @access public
     * @param  string $account The team or individual account owning the repo.
     * @param  string $repo    The repository identifier.
     * @param  string $node    The raw_node changeset identifier.
     * @return mixed
     */
    public function diffstat($account, $repo, $node)
    {
        return $this->requestGet(
            sprintf('repositories/%s/%s/changesets/%s/diffstat', $account, $repo, $node)
        );
    }

    /**
     * Get the diff associated with a changeset
     *
     * @access public
     * @param  string $account The team or individual account owning the repo.
     * @param  string $repo    The repository identifier.
     * @param  string $node    The raw_node changeset identifier.
     * @return mixed
     */
    public function diff($account, $repo, $node)
    {
        return $this->requestGet(
            sprintf('repositories/%s/%s/changesets/%s/diff', $account, $repo, $node)
        );
    }

    /**
     * Get comments
     *
     * @access public
     * @return Changesets\Comments
     * @codeCoverageIgnore
     */
    public function comments()
    {
        return $this->childFactory('Repositories\\Changesets\\Comments');
    }
}
