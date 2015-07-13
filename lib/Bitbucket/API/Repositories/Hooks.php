<?php

/**
 * This file is part of the bitbucket-api package.
 *
 * (c) Alexandru Guzinschi <alex@gentle.ro>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Bitbucket\API\Repositories;

use Bitbucket\API;
use Buzz\Message\MessageInterface;

/**
 * @author Alexandru Guzinschi <alex@gentle.ro>
 */
class Hooks extends API\Api
{
    /**
     * @access public
     * @param  string           $account The team or individual account owning the repository.
     * @param  string           $repo    The repository identifier.
     * @param  array            $params  Additional service parameters
     * @return MessageInterface
     *
     * @throws \InvalidArgumentException
     */
    public function create($account, $repo, array $params = array())
    {
        $mandatory = array(
            'description'   => 'My webhook',
            'url'           => '',
            'active'        => true,
            'events'        => array()
        );

        $diff = array_diff(array_keys($mandatory), array_keys($params));

        if (count($diff) > 0) {
            throw new \InvalidArgumentException('Missing parameters for creating a new webhook.');
        }

        if (false === array_key_exists('events', $params) || 0 === count($params['events'])) {
            throw new \InvalidArgumentException('Missing events for creating a new webhook.');
        }

        return $this->getClient()->setApiVersion('2.0')->post(
            sprintf('repositories/%s/%s/hooks', $account, $repo),
            json_encode($params),
            array('Content-Type' => 'application/json')
        );
    }

    /**
     * @access public
     * @param  string           $account The team or individual account owning the repository.
     * @param  string           $repo    The repository identifier.
     * @param  string           $uuid    The universally unique identifier of the webhook.
     * @param  array            $params  Additional service parameters
     * @return MessageInterface
     *
     * @throws \InvalidArgumentException
     */
    public function update($account, $repo, $uuid, array $params = array())
    {
        $mandatory = array(
            'description'   => 'My webhook',
            'url'           => '',
            'active'        => true,
            'events'        => array()
        );

        $diff = array_diff(array_keys($mandatory), array_keys($params));

        if (count($diff) > 0) {
            throw new \InvalidArgumentException('Missing parameters for updating a webhook.');
        }

        if (false === array_key_exists('events', $params) || 0 === count($params['events'])) {
            throw new \InvalidArgumentException('Missing events for updating a new webhook.');
        }

        return $this->getClient()->setApiVersion('2.0')->put(
            sprintf('repositories/%s/%s/hooks/%s', $account, $repo, $uuid),
            json_encode($params),
            array('Content-Type' => 'application/json')
        );
    }

    /**
     * @access public
     * @param  string           $account The team or individual account owning the repository.
     * @param  string           $repo    The repository identifier.
     * @return MessageInterface
     */
    public function all($account, $repo)
    {
        return $this->getClient()->setApiVersion('2.0')->get(
            sprintf('repositories/%s/%s/hooks', $account, $repo)
        );
    }

    /**
     * @access public
     * @param  string           $account The team or individual account owning the repository.
     * @param  string           $repo    The repository identifier.
     * @param  string           $uuid    The universally unique identifier of the webhook.
     * @return MessageInterface
     */
    public function get($account, $repo, $uuid)
    {
        return $this->getClient()->setApiVersion('2.0')->get(
            sprintf('repositories/%s/%s/hooks/%s', $account, $repo, $uuid)
        );
    }

    /**
     * @access public
     * @param  string           $account The team or individual account owning the repository.
     * @param  string           $repo    The repository identifier.
     * @param  string           $uuid    The universally unique identifier of the webhook.
     * @return MessageInterface
     */
    public function delete($account, $repo, $uuid)
    {
        return $this->getClient()->setApiVersion('2.0')->delete(
            sprintf('repositories/%s/%s/hooks/%s', $account, $repo, $uuid)
        );
    }
}
