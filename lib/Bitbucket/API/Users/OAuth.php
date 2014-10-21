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
 * Allows you to maintain OAuth consumers.
 *
 * @author  Alexandru G.    <alex@gentle.ro>
 */
class OAuth extends Api
{
    /**
     * Get all OAuth consumers
     *
     * @access public
     * @param  string           $account The name of an individual or team account.
     * @return MessageInterface
     */
    public function all($account)
    {
        return $this->requestGet(
            sprintf('users/%s/consumers', $account)
        );
    }

    /**
     * Create new OAuth consumer
     *
     * @access public
     * @param  string           $account     The name of an individual or team account.
     * @param  string           $name        A display name for the key.
     * @param  string           $description A description of the key. (optional)
     * @param  string           $url         The location of the service that will use the key. (optional)
     * @return MessageInterface
     */
    public function create($account, $name, $description = null, $url = null)
    {
        $params = array('name' => $name);

        if (!is_null($description)) {
            $params['description'] = $description;
        }

        if (!is_null($url)) {
            $params['url'] = $url;
        }

        return $this->requestPost(
            sprintf('users/%s/consumers', $account),
            $params
        );
    }

    /**
     * Update an OAuth consumer
     *
     * @access public
     * @param  string           $account     The name of an individual or team account.
     * @param  string           $name        A display name for the key.
     * @param  int              $keyId       The id of the key to update.
     * @param  string           $description A description of the key. (optional)
     * @param  string           $url         The location of the service that will use the key. (optional)
     * @return MessageInterface
     */
    public function update($account, $name, $keyId, $description = null, $url = null)
    {
        $params = array('name' => $name);

        if (!is_null($description)) {
            $params['description'] = $description;
        }

        if (!is_null($url)) {
            $params['url'] = $url;
        }

        return $this->requestPut(
            sprintf('users/%s/consumers/%d', $account, $keyId),
            $params
        );
    }

    /**
     * Delete OAuth consumer
     *
     * @access public
     * @param  string           $account The name of an individual or team account.
     * @param  int              $keyId   The id of the key to delete.
     * @return MessageInterface
     */
    public function delete($account, $keyId)
    {
        return $this->requestDelete(
            sprintf('users/%s/consumers/%d', $account, $keyId)
        );
    }
}
