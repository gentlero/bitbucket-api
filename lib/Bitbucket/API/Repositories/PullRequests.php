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
     * @param  string $account The team or individual account owning the repository.
     * @param  string $repo    The repository identifier.
     * @param  array  $params  Additional parameters
     * @return mixed
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
}
