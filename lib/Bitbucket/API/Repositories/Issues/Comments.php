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
class Comments extends API\Api
{
    /**
     * Get all comments for specified issue
     *
     * Comments are returned in DESC order by posted date.
     *
     * @access public
     * @param  string $account The team or individual account owning the repository.
     * @param  string $repo    The repository identifier.
     * @param  int    $issueID The issue identifier.
     * @return mixed
     */
    public function all($account, $repo, $issueID)
    {
        return $this->requestGet(
            sprintf('repositories/%s/%s/issues/%d/comments', $account, $repo, $issueID)
        );
    }

    /**
     * Get an individual comment for specified issue
     *
     * @access public
     * @param  string $account   The team or individual account owning the repository.
     * @param  string $repo      The repository identifier.
     * @param  int    $issueID   The issue identifier.
     * @param  int    $commentID The comment identifier.
     * @return mixed
     */
    public function get($account, $repo, $issueID, $commentID)
    {
        return $this->requestGet(
            sprintf('repositories/%s/%s/issues/%d/comments/%d', $account, $repo, $issueID, $commentID)
        );
    }

    /**
     * Add a new comment to specified issue
     *
     * @access public
     * @param  string $account The team or individual account owning the repository.
     * @param  string $repo    The repository identifier.
     * @param  int    $issueID The issue identifier.
     * @param  string $content The comment.
     * @return mixed
     */
    public function create($account, $repo, $issueID, $content)
    {
        return $this->requestPost(
            sprintf('repositories/%s/%s/issues/%d/comments', $account, $repo, $issueID),
            array('content' => $content)
        );
    }

    /**
     * Update an existing comment to specified issue
     *
     * @access public
     * @param  string $account   The team or individual account owning the repository.
     * @param  string $repo      The repository identifier.
     * @param  int    $issueID   The issue identifier.
     * @param  string $content   The comment.
     * @param  int    $commentID The comment identifier.
     * @return mixed
     */
    public function update($account, $repo, $issueID, $commentID, $content)
    {
        return $this->requestPut(
            sprintf('repositories/%s/%s/issues/%d/comments/%d', $account, $repo, $issueID, $commentID),
            array('content' => $content)
        );
    }
}
