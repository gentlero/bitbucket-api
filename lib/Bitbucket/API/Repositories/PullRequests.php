<?php

/*
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
 * PullRequests class
 *
 * Manage the comments on pull requests.
 *
 * @author  Alexandru G.    <alex@gentle.ro>
 */
class PullRequests extends API\Api
{
    /**
     * Get comments
     *
     * @access public
     * @return PullRequests\Comments
     * @codeCoverageIgnore
     */
    public function comments()
    {
        return $this->childFactory('Repositories\\PullRequests\\Comments');
    }

    /**
     * Get a list of pull requests
     *
     * @access public
     * @param  string           $account The team or individual account owning the repository.
     * @param  string           $repo    The repository identifier.
     * @param  array            $params  Additional parameters
     * @return MessageInterface
     */
    public function all($account, $repo, $params = array())
    {
        $params = array_merge(
            array(
                'state' => 'OPEN'
            ),
            $params
        );

        $this->httpClient->setApiVersion('2.0');

        return $this->requestGet(
            sprintf('repositories/%s/%s/pullrequests', $account, $repo),
            $params
        );
    }

    /**
     * Create a new pull request
     *
     * @access public
     * @param  string           $account The team or individual account owning the repository.
     * @param  string           $repo    The repository identifier.
     * @param  array            $params  Additional parameters
     * @return MessageInterface
     *
     * @see https://confluence.atlassian.com/x/XAZAGQ
     */
    public function create($account, $repo, $params = array())
    {
        // allow developer to directly specify params as json if (s)he wants.
        if (!empty($params) && is_array($params)) {
            $params = json_encode(array_merge(
                array(
                    'title' => 'New pull request',
                    'source' => array(
                        'branch' => array(
                            'name'  => 'develop'
                        )
                    )
                ),
                $params
            ));
        }

        return $this->getClient()->setApiVersion('2.0')->post(
            sprintf('repositories/%s/%s/pullrequests', $account, $repo),
            $params,
            array('Content-Type' => 'application/json')
        );
    }

    /**
     * Update a pull request
     *
     * @access public
     * @param  string           $account The team or individual account owning the repository.
     * @param  string           $repo    The repository identifier.
     * @param  int              $id      ID of the pull request that will be updated
     * @param  array            $params  Additional parameters
     * @return MessageInterface
     */
    public function update($account, $repo, $id, $params = array())
    {
        // allow developer to directly specify params as json if (s)he wants.
        if (!empty($params) && is_array($params)) {
            $params = json_encode(array_merge(
                array(
                    'title' => 'Updated pull request',
                    'destination' => array(
                        'branch' => array(
                            'name'  => 'develop'
                        )
                    )
                ),
                $params
            ));
        }

        return $this->getClient()->setApiVersion('2.0')->put(
            sprintf('repositories/%s/%s/pullrequests/%d', $account, $repo, $id),
            $params,
            array('Content-Type' => 'application/json')
        );
    }

    /**
     * Get a specific pull request
     *
     * @access public
     * @param  string           $account The team or individual account owning the repository.
     * @param  string           $repo    The repository identifier.
     * @param  int              $id      ID of the pull request
     * @return MessageInterface
     */
    public function get($account, $repo, $id)
    {
        return $this->getClient()->setApiVersion('2.0')->get(
            sprintf('repositories/%s/%s/pullrequests/%d', $account, $repo, $id)
        );
    }

    /**
     * Get the commits for a pull request
     *
     * @access public
     * @param  string           $account The team or individual account owning the repository.
     * @param  string           $repo    The repository identifier.
     * @param  int              $id      ID of the pull request
     * @return MessageInterface
     */
    public function commits($account, $repo, $id)
    {
        return $this->getClient()->setApiVersion('2.0')->get(
            sprintf('repositories/%s/%s/pullrequests/%d/commits', $account, $repo, $id)
        );
    }
}
