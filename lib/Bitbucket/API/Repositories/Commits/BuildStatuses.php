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
 * @author  Brice M. <brice.mancone@gmail.com>
 */
class BuildStatuses extends Api
{
    /**
     * Returns the status for specific build associated with a commit.
     *
     * @access public
     * @param  string           $account    The team or individual account owning the repository.
     * @param  string           $repository The repository identifier.
     * @param  string           $revision   A SHA1 value for the commit.
     * @param  string           $key        The key that distinguishes the build status from others.
     * @return MessageInterface
     *
     * @see https://confluence.atlassian.com/bitbucket/buildstatus-resource-779295267.html
     */
    public function get($account, $repository, $revision, $key)
    {
        return $this->getClient()->setApiVersion('2.0')->get(
            sprintf('repositories/%s/%s/commit/%s/statuses/build/%s', $account, $repository, $revision, $key)
        );
    }

    /**
     * Adds a build status to a commit.
     * If the build is already associated with the commit, a POST also updates the status.
     *
     * @access public
     * @param  string           $account    The team or individual account owning the repository.
     * @param  string           $repository The repository identifier.
     * @param  string           $revision   A SHA1 value for the commit.
     * @param  array            $params     The status.
     * @return MessageInterface
     *
     * @see https://confluence.atlassian.com/bitbucket/buildstatus-resource-779295267.html
     */
    public function create($account, $repository, $revision, $params)
    {
        return $this->getClient()->setApiVersion('2.0')->post(
            sprintf('repositories/%s/%s/commit/%s/statuses/build', $account, $repository, $revision),
            json_encode($params),
            array('Content-Type' => 'application/json')
        );
    }

    /**
     * Updates the build status for a commit.
     *
     * @access public
     * @param  string           $account    The team or individual account owning the repository.
     * @param  string           $repository The repository identifier.
     * @param  string           $revision   A SHA1 value for the commit.
     * @param  string           $key        The key that distinguishes the build status from others.
     * @param  array            $params     The status.
     * @return MessageInterface
     *
     * @see https://confluence.atlassian.com/bitbucket/buildstatus-resource-779295267.html
     */
    public function update($account, $repository, $revision, $key, $params)
    {
        return $this->getClient()->setApiVersion('2.0')->put(
            sprintf('repositories/%s/%s/commit/%s/statuses/build/%s', $account, $repository, $revision, $key),
            json_encode($params),
            array('Content-Type' => 'application/json')
        );
    }
}
