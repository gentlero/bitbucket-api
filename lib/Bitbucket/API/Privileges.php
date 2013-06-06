<?php

/*
 * This file is part of the bitbucket-api package.
 *
 * (c) Alexandru G. <alex@gentle.ro>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Bitbucket\API;

/**
 * Privileges class
 *
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
}
