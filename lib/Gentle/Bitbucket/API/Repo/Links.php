<?php

/*
 * This file is part of the bitbucket-api package.
 *
 * (c) Alexandru G. <alex@gentle.ro>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gentle\Bitbucket\API\Repo;

use Gentle\Bitbucket\API;

/**
 * Links class
 *
 * Links connect your commit messages and code comments directly to your
 * JIRA issue tracker or Bamboo build server.
 *
 * @author  Alexandru G.    <alex@gentle.ro>
 */
class Links extends API\Api
{
    /**
     * Get list of links
     *
     * @access public
     * @param  string $account The team or individual account owning the repository.
     * @param  string $repo    The repository identifier.
     * @return mixed
     */
    public function all($account, $repo)
    {
        return $this->requestGet(
            sprintf('repositories/%s/%s/links', $account, $repo)
        );
    }

    /**
     * Get a link
     *
     * @access public
     * @param  string $account The team or individual account owning the repository.
     * @param  string $repo    The repository identifier.
     * @param  int    $linkID  The link id.
     * @return mixed
     */
    public function get($account, $repo, $linkID)
    {
        return $this->requestGet(
            sprintf('repositories/%s/%s/links/%d', $account, $repo, $linkID)
        );
    }
}
