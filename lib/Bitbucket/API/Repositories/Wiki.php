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

/**
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

    /**
     * Create a new page
     *
     * If no $path is specified, then the page title will be used to generate one.
     *
     * Note: Because the POST method from the wiki endpoint is not working (500 error),
     *      `create` method will use PUT instead of POST for adding a new page.
     *
     * @access public
     * @param  string $account The team or individual account owning the repository.
     * @param  string $repo    The repository identifier.
     * @param  string $title   Page title.
     * @param  string $content Page content.
     * @param  string $path    Path to the page. (optional)
     * @return mixed
     */
    public function create($account, $repo, $title, $content, $path = null)
    {
        if (is_null($path)) {
            $path = sprintf('/%s', $title);
        }

        return $this->requestPut(
            sprintf('repositories/%s/%s/wiki/%s', $account, $repo, $title),
            array('data' => $content, 'path' => $path)
        );
    }

    /**
     * Update a page
     *
     * If no $path is specified, then the page title will be used to generate one.
     *
     * @access public
     * @param  string $account The team or individual account owning the repository.
     * @param  string $repo    The repository identifier.
     * @param  string $title   Page title.
     * @param  string $content Page content.
     * @param  string $path    Path to the page. (optional)
     * @param  string $rev     The current revision of the file before it was modified. (optional)
     * @return mixed
     */
    public function update($account, $repo, $title, $content, $path = null, $rev = null)
    {
        if (is_null($path)) {
            $path = sprintf('/%s', $title);
        }

        $params = array('data' => $content, 'path' => $path);

        if (!is_null($rev)) {
            $params['rev'] = $rev;
        }

        return $this->requestPut(
            sprintf('repositories/%s/%s/wiki/%s', $account, $repo, $title),
            $params
        );
    }
}
