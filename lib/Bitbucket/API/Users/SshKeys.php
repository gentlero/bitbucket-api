<?php

/**
 * This file is part of the bitbucket-api package.
 *
 * (c) Alexandru G. <alex@gentle.ro>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Bitbucket\API\Users;

use Bitbucket\API\Api;

/**
 * Manipulate the ssh-keys on an individual or team account.
 *
 * @author  Alexandru G.    <alex@gentle.ro>
 */
class SshKeys extends Api
{
    /**
     * Gets a list of the keys associated with an account.
     *
     * @access public
     * @param  string $account The name of an individual or team account.
     * @return mixed
     */
    public function all($account)
    {
        return $this->requestGet(
            sprintf('users/%s/ssh-keys', $account)
        );
    }

    /**
     * Create a key on the specified account.
     *
     * @access public
     * @param  string $account The name of an individual or team account.
     * @param  string $key     The key value.
     * @param  string $label   A label for the key. (optional)
     * @return mixed
     */
    public function create($account, $key, $label = null)
    {
        $params['key'] = $key;

        if (!is_null($label)) {
            $params['label'] = $label;
        }

        return $this->requestPost(
            sprintf('users/%s/ssh-keys', $account),
            $params
        );
    }

    /**
     * Updates a key on the specified account.
     *
     * @access public
     * @param  string $account The name of an individual or team account.
     * @param  int    $key_id  Key identifier.
     * @param  string $key     The key value.
     * @return mixed
     */
    public function update($account, $key_id, $key)
    {
        return $this->requestPut(
            sprintf('users/%s/ssh-keys/%d', $account, $key_id),
            array('key' => $key)
        );
    }

    /**
     * Gets the content of the specified key_id.
     *
     * @access public
     * @param  string $account The name of an individual or team account.
     * @param  int    $key_id  Key identifier.
     * @return mixed
     */
    public function get($account, $key_id)
    {
        return $this->requestGet(
            sprintf('users/%s/ssh-keys/%d', $account, $key_id)
        );
    }

    /**
     * Deletes the key specified by the key_id value
     *
     * @access public
     * @param  string $account The name of an individual or team account.
     * @param  int    $key_id  Key identifier.
     * @return mixed
     */
    public function delete($account, $key_id)
    {
        return $this->requestDelete(
            sprintf('users/%s/ssh-keys/%d', $account, $key_id)
        );
    }
}
