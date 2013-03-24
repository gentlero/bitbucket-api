<?php

/*
 * This file is part of the bitbucket_api package.
 *
 * (c) Alexandru G. <alex@gentle.ro>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gentle\Bitbucket\API\Repo;

use Gentle\Bitbucket\API;

/**
 * Deploykeys class
 *
 * Manage ssh keys used for deploying product builds.
 *
 * @author  Alexandru G.    <alex@gentle.ro>
 */
class Deploykeys extends API\Api
{
    /**
     * Get a list of keys
     *
     * @access public
     * @param  string $account The team or individual account owning the repository.
     * @param  string $repo    The repository identifier.
     * @return mixed
     */
    public function all($account, $repo)
    {
        return $this->requestGet(
            sprintf('repositories/%s/%s/deploy-keys', $account, $repo)
        );
    }
}
