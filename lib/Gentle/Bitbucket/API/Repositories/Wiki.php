<?php

/*
 * This file is part of the bitbucket-api package.
 *
 * (c) Alexandru G. <alex@gentle.ro>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gentle\Bitbucket\API\Repositories;

use Gentle\Bitbucket\API;

/**
 * Wiki class
 *
 * Provides functionality for getting information from pages in
 * a Bitbucket wiki, creating new pages, and updating them.
 *
 * @author  Alexandru G.    <alex@gentle.ro>
 */
class Wiki extends API\Api
{
    /**
     * Get the raw content of a Wiki page
     *
     * @access public
     * @param  string $account The team or individual account owning the repository.
     * @param  string $repo    The repository identifier.
     * @param  string $page    Page title. (case sensitive)
     * @return mixed
     */
    public function get($account, $repo, $page)
    {
        return $this->requestGet(
            sprintf('repositories/%s/%s/wiki/%s', $account, $repo, $page)
        );
    }
}
