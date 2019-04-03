<?php

/**
 * This file is part of the bitbucket-api package.
 *
 * (c) Alexandru G. <alex@gentle.ro>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Bitbucket\API\Repositories\PullRequests;

use Bitbucket\API;
use Buzz\Message\MessageInterface;

/**
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
     * @param  string           $account The team or individual account owning the repository.
     * @param  string           $repo    The repository identifier.
     * @param  int              $id      ID of the pull request
     * @return MessageInterface
     */
    public function all($account, $repo, $id)
    {
        return $this->getClient()->setApiVersion('2.0')->get(
            sprintf('repositories/%s/%s/pullrequests/%d/comments', $account, $repo, $id)
        );
    }

    /**
     * Get an individual pull request comment
     *
     * @access public
     * @param  string           $account   The team or individual account owning the repository.
     * @param  string           $repo      The repository identifier.
     * @param  int              $requestID An integer representing an id for the request.
     * @param  int              $commentID The comment identifier.
     * @return MessageInterface
     */
    public function get($account, $repo, $requestID, $commentID)
    {
        return $this->getClient()->setApiVersion('2.0')->get(
            sprintf('repositories/%s/%s/pullrequests/%d/comments/%d', $account, $repo, $requestID, $commentID)
        );
    }

    /**
     * Add a new comment
     *
     * @access public
     * @param  string           $account   The team or individual account owning the repository.
     * @param  string           $repo      The repository identifier.
     * @param  int              $requestID An integer representing an id for the request.
     * @param  string           $content   The comment.
     * @return MessageInterface
     */
    public function create($account, $repo, $requestID, $content)
    {
        return $this->getClient()->setApiVersion('2.0')->post(
            sprintf('repositories/%s/%s/pullrequests/%d/comments', $account, $repo, $requestID),
            json_encode(array('content' => array('raw' => $content))),
            array('Content-Type' => 'application/json')
        );
    }

    /**
     * Update an existing comment
     *
     * @access public
     * @param  string           $account   The team or individual account owning the repository.
     * @param  string           $repo      The repository identifier.
     * @param  int              $requestID An integer representing an id for the request.
     * @param  string           $content   The comment.
     * @param  int              $commentID The comment identifier.
     * @return MessageInterface
     */
    public function update($account, $repo, $requestID, $commentID, $content)
    {
        return $this->getClient()->setApiVersion('2.0')->put(
            sprintf('repositories/%s/%s/pullrequests/%d/comments/%d', $account, $repo, $requestID, $commentID),
            json_encode(array('content' => array('raw' => $content))),
            array('Content-Type' => 'application/json')
        );
    }

    /**
     * Delete a pull request comment
     *
     * @access public
     * @param  string           $account   The team or individual account owning the repository.
     * @param  string           $repo      The repository identifier.
     * @param  int              $requestID An integer representing an id for the request.
     * @param  int              $commentID The comment identifier.
     * @return MessageInterface
     */
    public function delete($account, $repo, $requestID, $commentID)
    {
        return $this->getClient()->setApiVersion('2.0')->delete(
            sprintf('repositories/%s/%s/pullrequests/%d/comments/%d', $account, $repo, $requestID, $commentID)
        );
    }
}
