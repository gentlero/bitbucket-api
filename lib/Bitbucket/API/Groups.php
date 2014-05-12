<?php

/**
 * This file is part of the bitbucket-api package.
 *
 * (c) Alexandru G. <alex@gentle.ro>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Bitbucket\API;

/**
 * Provides functionality for querying information about groups,
 * creating new ones, updating memberships, and deleting them.
 *
 * @author  Alexandru G.    <alex@gentle.ro>
 */
class Groups extends Api
{
    /**
     * Get a list of groups.
     *
     * If `$filters` is not omitted, will return a list of matching groups.
     *
     * <example>
     * $filters = array(
     *     'group' => array('account_name/group_slug', 'other_account/group_slug')
     * );
     * </example>
     *
     * @access public
     * @param  string $account The team or individual account owning the repository.
     * @param  array  $filters
     * @return mixed
     */
    public function get($account, array $filters = array())
    {
        // Default: fetch groups list
        $endpoint = sprintf('groups/%s/', $account);

        if (!empty($filters)) {
            $endpoint = 'groups';

            if (isset($filters['group']) && is_array($filters['group'])) {
                $filters['group'] = implode('&group=', $filters['group']);
            }
        }

        return $this->requestGet($endpoint, $filters);
    }

    /**
     * Create a new group
     *
     * @access public
     * @param  string $account The team or individual account owning the repository.
     * @param  string $name    The name of the group.
     * @return mixed
     */
    public function create($account, $name)
    {
        return $this->requestPost(
            sprintf('groups/%s/', $account),
            array('name' => $name)
        );
    }

    /**
     * Update a group
     *
     * @access public
     * @param  string $account The team or individual account owning the repository.
     * @param  string $name    The name of the group.
     * @param  array  $params
     * @return mixed
     */
    public function update($account, $name, array $params)
    {
        return $this->requestPut(
            sprintf('groups/%s/%s/', $account, $name),
            $params
        );
    }

    /**
     * Delete a group
     *
     * @access public
     * @param  string $account The team or individual account owning the repository.
     * @param  string $name    The name of the group.
     * @return mixed
     */
    public function delete($account, $name)
    {
        return $this->requestDelete(
            sprintf('groups/%s/%s/', $account, $name)
        );
    }

    /**
     * Get members
     *
     * @access public
     * @return Groups\Members
     * @codeCoverageIgnore
     */
    public function members()
    {
        return $this->childFactory('Groups\\Members');
    }
}
