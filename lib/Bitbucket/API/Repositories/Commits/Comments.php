<?php

/**
 * This file is part of the bitbucket-api package.
 *
 * (c) Alexandru G. <alex@gentle.ro>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Bitbucket\API\Repositories\Commits;

use Bitbucket\API\Api;
use Buzz\Message\MessageInterface;

/**
 * @author  Alexandru G.    <alex@gentle.ro>
 */
class Comments extends Api
{
    /**
     * Get a list of a commit comments
     *
     * @access public
     * @param  string           $account  The team or individual account owning the repository.
     * @param  string           $repo     The repository identifier.
     * @param  string           $revision A SHA1 value for the commit.
     * @return MessageInterface
     */
    public function all($account, $repo, $revision)
    {
        return $this->getClient()->setApiVersion('2.0')->get(
            sprintf('repositories/%s/%s/commit/%s/comments', $account, $repo, $revision)
        );
    }

    /**
     * Get an individual commit comment
     *
     * @access public
     * @param  string           $account   The team or individual account owning the repository.
     * @param  string           $repo      The repository identifier.
     * @param  string           $revision  A SHA1 value for the commit.
     * @param  int              $commentID The comment identifier.
     * @return MessageInterface
     */
    public function get($account, $repo, $revision, $commentID)
    {
        return $this->getClient()->setApiVersion('2.0')->get(
            sprintf('repositories/%s/%s/commit/%s/comments/%d', $account, $repo, $revision, $commentID)
        );
    }
}
