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
 * Allows you to create a new repository or edit a specific one.
 *
 * @author  Alexandru G.    <alex@gentle.ro>
 */
class Repository extends API\Api
{
    /**
     * Get information associated with an individual repository.
     *
     * @access public
     * @param  string           $account The team or individual account owning the repository.
     * @param  string           $repo    The repository identifier.
     * @return MessageInterface
     */
    public function get($account, $repo)
    {
        return $this->getClient()->setApiVersion('2.0')->get(
            sprintf('repositories/%s/%s', $account, $repo)
        );
    }

    /**
     * Create a new repository
     *
     * If `$params` are omitted, a private git repository will be created,
     * with a "no forking" policy.
     *
     * @access public
     * @param  string           $account The team or individual account owning the repository.
     * @param  string           $repo    The repository identifier.
     * @param  array            $params  Additional parameters
     * @return MessageInterface
     *
     * @see https://confluence.atlassian.com/x/WwZAGQ
     */
    public function create($account, $repo, $params = array())
    {
        // Keep BC for now.
        // @todo[1]: to be removed.
        if (is_array($repo)) {
            return $this->createLegacy($account, $repo);
        }

        // allow developer to directly specify params as json if (s)he wants.
        if (!empty($params) && is_array($params)) {
            $params = json_encode(array_merge(
                array(
                    'scm'               => 'git',
                    'name'              => $repo,
                    'is_private'        => true,
                    'description'       => 'My secret repo',
                    'forking_policy'    => 'no_forks',
                ),
                $params
            ));
        }

        return $this->getClient()->setApiVersion('2.0')->post(
            sprintf('repositories/%s/%s', $account, $repo),
            $params,
            array('Content-Type' => 'application/json')
        );
    }

    /**
     * Create a new repository
     *
     * Available `$params`:
     *
     * <example>
     * 'description'    (string) = A description of the repository.
     * 'scm'            (string) = A value of git or hg. The default is git if you leave this parameter unspecified.
     * 'language'       (string) = The language used for source code in the repository.
     * 'is_private'     (bool) = The repository is private (true) or public (false).  The default is false.
     * </example>
     *
     * @access public
     * @param  string $name   The name of the repository
     * @param  array  $params Additional parameters
     * @return mixed
     *
     * @deprecated This API 1.0 endpoint is deprecated.
     * @see $this->create() Sintax for using API 2.0 endpoint
     */
    private function createLegacy($name, array $params = array())
    {
        $params['name'] = $name;

        return $this->requestPost(
            sprintf('repositories'),
            $params
        );
    }

    /**
     * Update a repository
     *
     * @access public
     * @param  string $account The team or individual account owning the repository.
     * @param  string $repo    The repository identifier.
     * @param  array  $params  Additional parameters
     * @return mixed
     *
     * @see https://confluence.atlassian.com/x/WwZAGQ
     */
    public function update($account, $repo, array $params = array())
    {
        return $this->requestPut(
            sprintf('repositories/%s/%s', $account, $repo),
            $params
        );
    }

    /**
     * Delete a repository
     *
     * @access public
     * @param  string           $account The team or individual account owning the repository.
     * @param  string           $repo    The repository identifier.
     * @return MessageInterface
     */
    public function delete($account, $repo)
    {
        return $this->getClient()->setApiVersion('2.0')->delete(
            sprintf('repositories/%s/%s', $account, $repo)
        );
    }

    /**
     * Gets the list of accounts watching a repository.
     *
     * @access public
     * @param  string           $account The team or individual account owning the repository.
     * @param  string           $repo    The repository identifier.
     * @return MessageInterface
     */
    public function watchers($account, $repo)
    {
        return $this->getClient()->setApiVersion('2.0')->get(
            sprintf('repositories/%s/%s/watchers', $account, $repo)
        );
    }

    /**
     * Gets the list of repository forks.
     *
     * @access public
     * @param  string           $account The team or individual account owning the repository.
     * @param  string           $repo    The repository identifier.
     * @return MessageInterface
     */
    public function forks($account, $repo)
    {
        return $this->getClient()->setApiVersion('2.0')->get(
            sprintf('repositories/%s/%s/forks', $account, $repo)
        );
    }

    /**
     * Fork a repository
     *
     * @access public
     * @param  string $account The team or individual account owning the repository.
     * @param  string $repo    The repository identifier.
     * @param  string $name    Fork name
     * @param  array  $params  Additional parameters
     * @return mixed
     *
     * @see https://confluence.atlassian.com/display/BITBUCKET/repository+Resource#repositoryResource-POSTanewfork
     */
    public function fork($account, $repo, $name, array $params = array())
    {
        $params['name'] = $name;

        return $this->requestPost(
            sprintf('repositories/%s/%s/fork', $account, $repo),
            $params
        );
    }

    /**
     * Get a list of branches associated with a repository.
     *
     * @access public
     * @param  string $account The team or individual account owning the repository.
     * @param  string $repo    The repository identifier.
     * @return mixed
     */
    public function branches($account, $repo)
    {
        return $this->requestGet(
            sprintf('repositories/%s/%s/branches', $account, $repo)
        );
    }

    /**
     * Get the repository's main branch
     *
     * @access public
     * @param  string $account The team or individual account owning the repository.
     * @param  string $repo    The repository identifier.
     * @return mixed
     */
    public function branch($account, $repo)
    {
        return $this->requestGet(
            sprintf('repositories/%s/%s/main-branch', $account, $repo)
        );
    }

    /**
     * Get the repository manifest
     *
     * @access public
     * @param  string $account  The team or individual account owning the repository.
     * @param  string $repo     The repository identifier.
     * @param  string $revision A revision to get such as default or master.
     * @return mixed
     */
    public function manifest($account, $repo, $revision)
    {
        return $this->requestGet(
            sprintf('repositories/%s/%s/manifest/%s', $account, $repo, $revision)
        );
    }

    /**
     * Get a list of tags
     *
     * @access public
     * @param  string $account The team or individual account owning the repository.
     * @param  string $repo    The repository identifier.
     * @return mixed
     */
    public function tags($account, $repo)
    {
        return $this->requestGet(
            sprintf('repositories/%s/%s/tags', $account, $repo)
        );
    }

    /**
     * Get the raw source
     *
     * Get the raw content of a file or directory.
     *
     * @access public
     * @param  string $account The team or individual account owning the repository.
     * @param  string $repo    The repository identifier.
     * @param  string $rev     A value representing the revision or branch to list.
     * @param  string $path    The path can be a filename or a directory path.
     * @return mixed
     */
    public function raw($account, $repo, $rev, $path)
    {
        return $this->requestGet(
            sprintf('repositories/%s/%s/raw/%s/%s', $account, $repo, $rev, $path)
        );
    }

    /**
     * Get the history of a file in a changeset
     *
     * Returns the history of a file starting from the provided changeset.
     *
     * @access public
     * @param  string $account The team or individual account owning the repository.
     * @param  string $repo    The repository identifier.
     * @param  string $node    The simple changeset node id.
     * @param  string $path    Filename.
     * @return mixed
     */
    public function filehistory($account, $repo, $node, $path)
    {
        return $this->requestGet(
            sprintf('repositories/%s/%s/filehistory/%s/%s', $account, $repo, $node, $path)
        );
    }
}
