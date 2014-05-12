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

    /**
     * Create a new link
     *
     * @access public
     * @param  string $account The team or individual account owning the repository.
     * @param  string $repo    The repository identifier.
     * @param  string $handler ex: jira, bamboo, crucible, jenkins, custom
     * @param  string $url     A valid URL that starts with either http or https.
     * @param  string $key     This parameter is the project key that you are trying to link to.
     * @return mixed
     *
     * @throws \InvalidArgumentException
     *
     * @see https://confluence.atlassian.com/display/BITBUCKET/links+Resources#linksResources-POSTanewlink
     */
    public function create($account, $repo, $handler, $url, $key)
    {
        if (!in_array(strtolower($handler), array('jira', 'bamboo', 'crucible', 'jenkins', 'custom'))) {
            throw new \InvalidArgumentException(
                'Invalid handler provided.'
            );
        }

        return $this->requestPost(
            sprintf('repositories/%s/%s/links', $account, $repo),
            array(
                'handler'   => $handler,
                'link_url'  => $url,
                'link_key'  => $key
            )
        );
    }

    /**
     * Update a link
     *
     * @access public
     * @param  string $account The team or individual account owning the repository.
     * @param  string $repo    The repository identifier.
     * @param  int    $linkID  Link identifier.
     * @param  string $url     A valid URL that starts with either http or https.
     * @param  string $key     This parameter is the project key that you are trying to link to.
     * @return mixed
     *
     * @see https://confluence.atlassian.com/display/BITBUCKET/links+Resources#linksResources-PUTanupdatetoalink
     */
    public function update($account, $repo, $linkID, $url, $key)
    {
        return $this->requestPut(
            sprintf('repositories/%s/%s/links/%d', $account, $repo, $linkID),
            array(
                'link_url'  => $url,
                'link_key'  => $key
            )
        );
    }

    /**
     * Delete a link
     *
     * @access public
     * @param  string $account The team or individual account owning the repository.
     * @param  string $repo    The repository identifier.
     * @param  int    $linkID  Link identifier.
     * @return mixed
     */
    public function delete($account, $repo, $linkID)
    {
        return $this->requestDelete(
            sprintf('repositories/%s/%s/links/%d', $account, $repo, $linkID)
        );
    }
}
