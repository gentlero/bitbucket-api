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
use Buzz\Message\MessageInterface;

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
     * @param  string           $account The name of an individual or team account.
     * @return MessageInterface
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
     * @param  string           $account The name of an individual or team account.
     * @param  string           $key     The key value.
     * @param  string           $label   A label for the key. (optional)
     * @return MessageInterface
     */
    public function create($account, $key, $label = null)
    {
        $params = array('key' => $key);

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
     * @param  string           $account The name of an individual or team account.
     * @param  int              $keyId   Key identifier.
     * @param  string           $key     The key value.
     * @return MessageInterface
     */
    public function update($account, $keyId, $key)
    {
        return $this->requestPut(
            sprintf('users/%s/ssh-keys/%d', $account, $keyId),
            array('key' => $key)
        );
    }

    /**
     * Gets the content of the specified keyId.
     *
     * @access public
     * @param  string           $account The name of an individual or team account.
     * @param  int              $keyId   Key identifier.
     * @return MessageInterface
     */
    public function get($account, $keyId)
    {
        return $this->requestGet(
            sprintf('users/%s/ssh-keys/%d', $account, $keyId)
        );
    }

    /**
     * Deletes the key specified by the keyId value
     *
     * @access public
     * @param  string           $account The name of an individual or team account.
     * @param  int              $keyId   Key identifier.
     * @return MessageInterface
     */
    public function delete($account, $keyId)
    {
        return $this->requestDelete(
            sprintf('users/%s/ssh-keys/%d', $account, $keyId)
        );
    }
}
