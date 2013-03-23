<?php

/*
 * This file is part of the bitbucket_api package.
 *
 * (c) Alexandru G. <alex@gentle.ro>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gentle\Bitbucket\API\Repo\Changesets;

use Gentle\Bitbucket\API;

/**
 * Comments class
 *
 * Manage changeset comments.
 *
 * @author  Alexandru G.    <alex@gentle.ro>
 */
class Comments extends API\Api
{
    /**
     * Get a list of comments on a changeset
     *
     * @access public
     * @param  string $account The team or individual account owning the repo.
     * @param  string $repo    The repository identifier.
     * @param  string $node    The raw_node changeset identifier.
     * @return mixed
     */
    public function all($account, $repo, $node)
    {
        return $this->requestGet(
            sprintf('repositories/%s/%s/changesets/%s/comments', $account, $repo, $node)
        );
    }
}