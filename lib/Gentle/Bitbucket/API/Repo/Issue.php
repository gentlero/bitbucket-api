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
use Gentle\Bitbucket\API\Repo;

/**
 * Issue class
 *
 * [Class description]
 *
 * @author  Alexandru G.    <alex@gentle.ro>
 */
class Issue extends API\Api
{
    /**
     * GET a list of issues in a repository's tracker
     *
     * @access public
     * @param  string $account The team or individual account owning the repository.
     * @param  string $repo    The repository identifier.
     * @param  array  $options Filtering parameters.
     * @return mixed
     *
     * @see https://confluence.atlassian.com/display/BITBUCKET/issues+Resource#issuesResource-GETalistofissuesinarepository'stracker
     */
    public function all($account, $repo, $options = array())
    {
        return $this->requestGet(
            sprintf('repositories/%s/%s/issues', $account, $repo),
            $options
        );
    }

    /**
     * GET an individual issue
     *
     * @access public
     * @param  string $account The team or individual account owning the repository.
     * @param  string $repo    The repository identifier.
     * @param  int    $issueID The issue identifier.
     * @return mixed
     */
    public function get($account, $repo, $issueID)
    {
        return $this->requestGet(
            sprintf('repositories/%s/%s/issues/%d', $account, $repo, $issueID)
        );
    }

    /**
     * GET a list of an issue's followers
     *
     * @access public
     * @param  string $account The team or individual account owning the repository.
     * @param  string $repo    The repository identifier.
     * @param  int    $issueID The issue identifier.
     * @return mixed
     */
    public function followers($account, $repo, $issueID)
    {
        return $this->requestGet(
            sprintf('repositories/%s/%s/issues/%d/followers', $account, $repo, $issueID)
        );
    }

    /**
     * POST a new issue
     *
     * @access public
     * @param  string $account The team or individual account owning the repository.
     * @param  string $repo    The repository identifier.
     * @param  array  $options Issue parameters
     * @return mixed
     *
     * @throws \InvalidArgumentException
     *
     * @see https://confluence.atlassian.com/display/BITBUCKET/issues+Resource#issuesResource-POSTanewissue
     */
    public function create($account, $repo, $options = array())
    {
        if (!isset($options['title']) OR !isset($options['content'])) {
            throw new \InvalidArgumentException(
                'Arguments: "title" and "content" are mandatory.'
            );
        }

        return $this->requestPost(
            sprintf('repositories/%s/%s/issues', $account, $repo),
            $options
        );
    }

    /**
     * Update existing issue
     *
     * @access public
     * @param  string $account The team or individual account owning the repository.
     * @param  string $repo    The repository identifier.
     * @param  int    $issueID The issue identifier.
     * @param  array  $options Issue parameters
     * @return mixed
     *
     * @see https://confluence.atlassian.com/display/BITBUCKET/issues+Resource#issuesResource-Updateanexistingissue
     */
    public function update($account, $repo, $issueID, array $options)
    {
        return $this->requestPut(
            sprintf('repositories/%s/%s/issues/%d', $account, $repo, $issueID),
            $options
        );
    }

    /**
     * Delete issue
     *
     * @access public
     * @param  string $account The team or individual account owning the repository.
     * @param  string $repo    The repository identifier.
     * @param  int    $issueID The issue identifier.
     * @return bool
     */
    public function delete($account, $repo, $issueID)
    {
        return $this->requestDelete(
            sprintf('repositories/%s/%s/issues/%d', $account, $repo, $issueID)
        );
    }

    /**
     * Get comments
     *
     * @access public
     * @return Repo\Comments
     * @codeCoverageIgnore
     */
    public function comments()
    {
        $comments = new Repo\Comments( $this->client );

        if ( !is_null($this->auth)) {
            $comments->setCredentials( $this->auth );
        }

        return $comments;
    }

}
