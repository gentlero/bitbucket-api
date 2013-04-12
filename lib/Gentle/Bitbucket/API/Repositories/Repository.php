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
 * Repository class
 *
 * Allows you to create a new repository or edit a specific one.
 *
 * @author  Alexandru G.    <alex@gentle.ro>
 */
class Repository extends API\Api
{
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
     */
    public function create($name, array $params = array())
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
     * @see https://confluence.atlassian.com/display/BITBUCKET/repository+Resource#repositoryResource-PUTarepositoryupdate
     */
    public function update($account, $repo, array $params = array())
    {
        return $this->requestPut(
            sprintf('repositories/%s/%s', $account, $repo),
            $params
        );
    }
}
