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
 * Manage the user privileges (permissions) of your repositories. It allows you
 * to grant specific users access to read, write and or administer your repositories.
 *
 * @author  Alexandru G.    <alex@gentle.ro>
 */
class Privileges extends Api
{
    /**
     * Get a list of user privileges granted on a repository.
     *
     * @access public
     * @param  string                    $account   Owner of the repository.
     * @param  string                    $repo      Repository identifier.
     * @param  string                    $privilege Filters for a particular privilege.
     * @return mixed
     * @throws \InvalidArgumentException
     */
    public function repository($account, $repo, $privilege = null)
    {
        $params = array();

        if (!is_null($privilege)) {

            if (!in_array($privilege, array('read', 'write', 'admin'))) {
                throw new \InvalidArgumentException("Invalid privilege provided.");
            }

            $params['filter'] = $privilege;
        }

        return $this->requestGet(
            sprintf('privileges/%s/%s', $account, $repo),
            $params
        );
    }

    /**
     * Get privileges for an individual.
     *
     * @access public
     * @param  string $owner   Owner of the repository.
     * @param  string $repo    Repository identifier.
     * @param  string $account The account to list privileges for.
     * @return mixed
     */
    public function account($owner, $repo, $account)
    {
        return $this->requestGet(
            sprintf('privileges/%s/%s/%s', $owner, $repo, $account)
        );
    }

    /**
     * Get a list of all privileges across all an account's repositories.
     *
     * If a repository has no individual users with privileges, it does not appear in this list.
     *
     * @access public
     * @param  string                    $account   Owner of the repository.
     * @param  string                    $privilege Filters for a particular privilege.
     * @return mixed
     * @throws \InvalidArgumentException
     */
    public function repositories($account, $privilege = null)
    {
        $params = array();

        if (!is_null($privilege)) {

            if (!in_array($privilege, array('read', 'write', 'admin'))) {
                throw new \InvalidArgumentException("Invalid privilege provided.");
            }

            $params['filter'] = $privilege;
        }

        return $this->requestGet(
            sprintf('privileges/%s', $account),
            $params
        );
    }

    /**
     * Grants an account a privilege on a repository.
     *
     * @access public
     * @param  string                    $owner     Owner of the repository.
     * @param  string                    $repo      Repository identifier.
     * @param  string                    $account   The account to list privileges for.
     * @param  string                    $privilege The privilege to assign.
     * @return mixed
     * @throws \InvalidArgumentException
     */
    public function grant($owner, $repo, $account, $privilege)
    {
        if (!in_array($privilege, array('read', 'write', 'admin'))) {
            throw new \InvalidArgumentException("Invalid privilege provided.");
        }

        $params['filter'] = $privilege;

        return $this->requestPut(
            sprintf('privileges/%s/%s/%s', $owner, $repo, $account),
            $params
        );
    }

    /**
     * Delete account privileges from a repository
     *
     * if `$account` is specified, then all account privileges will be deleted from repository.
     * If `$account` is not specified, then all privileges from repository will be deleted.
     * If `repo` is not specified, then all privileges from all repositories will be deleted.
     *
     * @access public
     * @param  string                    $owner   Owner of the repository.
     * @param  string                    $repo    Repository identifier.
     * @param  string                    $account The account to list privileges for.
     * @return mixed
     * @throws \InvalidArgumentException
     */
    public function delete($owner, $repo = null, $account = null)
    {
        if (!is_null($account) and is_null($repo)) {
            throw new \InvalidArgumentException("To delete an account privileges, you need to specify a repository.");
        }

        $endpoint = sprintf('privileges/%s', $owner);

        if (!is_null($repo)) {
            $endpoint .= '/'.$repo;
        }

        if (!is_null($account)) {
            $endpoint .= '/'.$account;
        }

        return $this->requestDelete($endpoint);
    }
}
