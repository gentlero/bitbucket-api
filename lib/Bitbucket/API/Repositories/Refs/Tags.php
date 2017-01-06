<?php

/**
 * This file is part of the bitbucket-api package.
 *
 * (c) Alexandru G. <alex@gentle.ro>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Bitbucket\API\Repositories\Refs;

use Bitbucket\API;

/**
 * @author  Kevin Howe    <kjhowe@gmail.com>
 */
class Tags extends API\Api
{
    /**
     * Get a list of tags
     *
     * @access public
     * @param  string           $account The team or individual account owning the repository.
     * @param  string           $repo    The repository identifier.
     * @return MessageInterface
     */
    public function all($account, $repo)
    {
        return $this->getClient()->setApiVersion('2.0')->get(
            sprintf('repositories/%s/%s/refs/tags', $account, $repo)
        );
    }

    /**
     * Create a new tag
     *
     * @access public
     * @param  string           $account The team or individual account owning the repository.
     * @param  string           $repo    The repository identifier.
     * @param  string           $name    The name of the new tag.
     * @param  string           $hash    The hash to tag.
     * @return MessageInterface
     */
    public function create($account, $repo, $name, $hash)
    {
        $params = [
            'name' => $name,
            'target' => [
                'hash' => $hash,
            ],
        ];

        $data = json_encode($params);

        return $this->getClient()->setApiVersion('2.0')->post(
            sprintf('repositories/%s/%s/refs/tags', $account, $repo),
            $data,
            array('Content-Type' => 'application/json')
        );
    }
}
