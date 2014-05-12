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

use Bitbucket\API\Api;
use Buzz\Message\MessageInterface;

/**
 * Manage branch restrictions on a repository
 *
 * @author  Alexandru G.    <alex@gentle.ro>
 */
class BranchRestrictions extends Api
{
    /**
     * Get the information associated with a repository's branch restrictions
     *
     * @access public
     * @param  string           $account The team or individual account owning the repository.
     * @param  string           $repo    The repository identifier.
     * @return MessageInterface
     */
    public function all($account, $repo)
    {
        return $this->getClient()->setApiVersion('2.0')->get(
            sprintf('repositories/%s/%s/branch-restrictions', $account, $repo)
        );
    }

    /**
     * Creates restrictions for the specified repository.
     *
     * @access public
     * @param  string           $account The team or individual account owning the repository.
     * @param  string           $repo    The repository identifier.
     * @param  array            $params  Additional parameters
     * @return MessageInterface
     *
     * @throws \InvalidArgumentException
     */
    public function create($account, $repo, $params = array())
    {
        // allow developer to directly specify params as json if (s)he wants.
        if (!empty($params) && is_string($params)) {
            $params = $this->decodeJSON($params);
        }

        if (!empty($params) && is_array($params)) {
            $params = array_merge(
                array(
                    'kind' => 'push'
                ),
                $params
            );
        }

        if (empty($params['kind']) or !in_array($params['kind'], array('push', 'delete', 'force'))) {
            throw new \InvalidArgumentException('Invalid restriction kind.');
        }

        return $this->getClient()->setApiVersion('2.0')->post(
            sprintf('repositories/%s/%s/branch-restrictions', $account, $repo),
            json_encode($params),
            array('Content-Type' => 'application/json')
        );
    }

    /**
     * Get a specific restriction
     *
     * @access public
     * @param  string           $account The team or individual account owning the repository.
     * @param  string           $repo    The repository identifier.
     * @param  int              $id      The restriction's identifier.
     * @return MessageInterface
     */
    public function get($account, $repo, $id)
    {
        return $this->getClient()->setApiVersion('2.0')->get(
            sprintf('repositories/%s/%s/branch-restrictions/%d', $account, $repo, $id)
        );
    }

    /**
     * Updates a specific branch restriction.
     *
     * @access public
     * @param  string           $account The team or individual account owning the repository.
     * @param  string           $repo    The repository identifier.
     * @param  int              $id      The restriction's identifier.
     * @param  array            $params  Additional parameters
     * @return MessageInterface
     *
     * @throws \InvalidArgumentException
     */
    public function update($account, $repo, $id, $params = array())
    {
        // allow developer to directly specify params as json if (s)he wants.
        if (!empty($params) && is_string($params)) {
            $params = $this->decodeJSON($params);
        }

        if (!empty($params['kind'])) {
            throw new \InvalidArgumentException('You cannot change the "kind" value.');
        }

        return $this->getClient()->setApiVersion('2.0')->put(
            sprintf('repositories/%s/%s/branch-restrictions/%d', $account, $repo, $id),
            json_encode($params),
            array('Content-Type' => 'application/json')
        );
    }

    /**
     * Delete a specific branch restriction.
     *
     * @access public
     * @param  string           $account The team or individual account owning the repository.
     * @param  string           $repo    The repository identifier.
     * @param  int              $id      The restriction's identifier.
     * @return MessageInterface
     *
     * @throws \InvalidArgumentException
     */
    public function delete($account, $repo, $id)
    {
        return $this->getClient()->setApiVersion('2.0')->delete(
            sprintf('repositories/%s/%s/branch-restrictions/%d', $account, $repo, $id)
        );
    }
}
