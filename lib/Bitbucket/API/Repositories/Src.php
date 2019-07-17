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
use Buzz\Message\MessageInterface;

/**
 * Allows you to browse directories and view files.
 *
 * NOTE: This is read-only!
 *
 * @author  Alexandru G.    <alex@gentle.ro>
 */
class Src extends API\Api
{
    /**
     * Get raw content of an individual file, or the contents of a directory
     *
     * @access public
     * @param  string           $account  The team or individual account owning the repository.
     * @param  string           $repo     The repository identifier.
     * @param  string           $revision A value representing the revision or branch to list.
     * @param  string           $path     The path can be a filename or a directory path.
     * @return MessageInterface
     */
    public function get($account, $repo, $revision, $path)
    {
        return $this->getClient()->setApiVersion("2.0")->get(
            sprintf('repositories/%s/%s/src/%s/%s', $account, $repo, $revision, $path)
        );
    }

    /**
     * Create file in repository
     *      $params contains the files to create, the key is the file (with path) to create and the value is the
     *      data that will be written to the file.
     *      See https://developer.atlassian.com/bitbucket/api/2/reference/resource/repositories/%7Busername%7D/%7Brepo_slug%7D/src#post
     *      for details on what options are available
     * @param $account
     * @param $repo
     * @param array $params
     * @return MessageInterface
     */
    public function create($account, $repo, array $params = array())
    {
        $mandatory = array(
            'author'   => '',
            'message'  => '',
        );

        $diff = array_diff(array_keys($mandatory), array_keys($params));

        if (count($diff) > 0) {
            throw new \InvalidArgumentException('Missing parameters for creating new files.');
        }

        return $this->getClient()->setApiVersion('2.0')->post(
            sprintf('repositories/%s/%s/src', $account, $repo),
            $params
        );
    }
}
