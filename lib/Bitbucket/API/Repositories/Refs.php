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
 * @author  Kevin Howe    <kjhowe@gmail.com>
 */
class Refs extends API\Api
{
    /**
     * Get a list of refs
     *
     * @access public
     * @param  string           $account The team or individual account owning the repository.
     * @param  string           $repo    The repository identifier.
     * @param  string|array     $params  GET parameters
     * @return MessageInterface
     *
     * @throws \InvalidArgumentException
     */
    public function all($account, $repo, array $params = array())
    {
        return $this->getClient()->setApiVersion('2.0')->get(
            sprintf('repositories/%s/%s/refs', $account, $repo),
            $params
        );
    }
}
