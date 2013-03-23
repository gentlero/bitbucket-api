<?php

/*
 * This file is part of the bitbucket_api package.
 *
 * (c) Alexandru G. <alex@gentle.ro>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gentle\Bitbucket\API\Repo;

use Gentle\Bitbucket\API;

/**
 * Changesets class
 *
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
    public function get($account, $repo, $start = null, $limit = 15)
    {
        return $this->requestGet(
            sprintf('repositories/%s/%s/changesets', $account, $repo, $start, $limit),
            array(
                'start' => $start,
                'limit' => $limit
            )
        );
    }
}
