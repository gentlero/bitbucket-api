<?php

/**
 * This file is part of the bitbucket-api package.
 *
 * (c) Alexandru G. <alex@gentle.ro>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Bitbucket\API\Repositories\Changesets;

use Bitbucket\API;

/**
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

    /**
     * Delete a comment on a changeset
     *
     * @access public
     * @param  string $account   The team or individual account owning the repo.
     * @param  string $repo      The repository identifier.
     * @param  string $node      The raw_node changeset identifier.
     * @param  int    $commentID The comment identifier.
     * @return mixed
     */
    public function delete($account, $repo, $node, $commentID)
    {
        return $this->requestDelete(
            sprintf('repositories/%s/%s/changesets/%s/comments/%d', $account, $repo, $node, $commentID)
        );
    }

    /**
     * Post a new comment on a changeset
     *
     * Available `$options`:
     *
     * <example>
     * 'line_from'  (int) = An integer representing the starting line of the comment.
     * 'line_to'    (int) = An integer representing the ending line of the comment.
     * 'parent_id'  (int) = An integer representing the unique ID of comment to which this is a reply.
     * 'filename'   (string) = A String representing a filename in the changeset to which this comment applies.
     * </example>
     *
     * @access public
     * @param  string $account The team or individual account owning the repo.
     * @param  string $repo    The repo identifier.
     * @param  string $node    The raw_node changeset identifier.
     * @param  string $content Comment content.
     * @param  array  $options The rest of available options
     * @return mixed
     *
     * @see https://confluence.atlassian.com/x/6A2mEQ
     */
    public function create($account, $repo, $node, $content, $options = array())
    {
        return $this->requestPost(
            sprintf('repositories/%s/%s/changesets/%s/comments', $account, $repo, $node),
            array_merge(array('content' => $content), $options)
        );
    }

    /**
     * Update an existing changeset comment
     *
     * Available `$options`:
     *
     * <example>
     * 'line_from'  (int) = An integer representing the starting line of the comment.
     * 'line_to'    (int) = An integer representing the ending line of the comment.
     * 'parent_id'  (int) = An integer representing the unique ID of comment to which this is a reply.
     * 'filename'   (string) = A String representing a filename in the changeset to which this comment applies.
     * </example>
     *
     * @param  string $account   The team or individual account owning the repo.
     * @param  string $repo      The repo identifier.
     * @param  string $node      The raw_node changeset identifier.
     * @param  int    $commentID The comment identifier.
     * @param  string $content   Comment content.
     * @param  array  $options   The rest of available options
     * @return mixed
     *
     * @see https://confluence.atlassian.com/x/6A2mEQ
     */
    public function update($account, $repo, $node, $commentID, $content, $options = array())
    {
        return $this->requestPut(
            sprintf('repositories/%s/%s/changesets/%s/comments/%d', $account, $repo, $node, $commentID),
            array_merge(array('content' => $content), $options)
        );
    }
}
