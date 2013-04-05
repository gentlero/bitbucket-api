<?php

/*
 * This file is part of the bitbucket-api package.
 *
 * (c) Alexandru G. <alex@gentle.ro>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gentle\Bitbucket\API\Repo\PullRequest;

use Gentle\Bitbucket\API;

/**
 * Comments class
 *
 * Manage the comments on pull requests.
 *
 * @author  Alexandru G.    <alex@gentle.ro>
 */
class Comments extends API\Api
{
    /**
     * Get a list of a pull request comments
     *
     * @access public
     * @param  string $account   The team or individual account owning the repository.
     * @param  string $repo      The repository identifier.
     * @param  int    $requestID An integer representing an id for the request.
     * @return mixed
     */
    public function all($account, $repo, $requestID)
    {
        return $this->requestGet(
            sprintf('repositories/%s/%s/pullrequests/%d/comments', $account, $repo, $requestID)
        );
    }

    /**
     * Get an individual pull request comment
     *
     * @access public
     * @param  string $account   The team or individual account owning the repository.
     * @param  string $repo      The repository identifier.
     * @param  int    $requestID An integer representing an id for the request.
     * @param  int    $commentID The comment identifier.
     * @return mixed
     */
    public function get($account, $repo, $requestID, $commentID)
    {
        return $this->requestGet(
            sprintf('repositories/%s/%s/pullrequests/%d/comments/%d', $account, $repo, $requestID, $commentID)
        );
    }
}
