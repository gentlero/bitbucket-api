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

use Buzz\Message\MessageInterface;

/**
 * @author  Alexandru G.    <alex@gentle.ro>
 */
class Repositories extends Api
{
    /**
     * Get a list of repositories.
     *
     * - If the caller is properly authenticated and authorized, will also return
     *      the private repositories.
     * - If `$owner` is omitted, will return a list of all public repositories on Bitbucket.
     *
     * @access public
     * @param  string $owner The account of the repo owner.
     * @return MessageInterface
     *
     * @api 2.0
     * @since Method available since 0.2.0
     */
    public function all($owner = null)
    {
        $endpoint = 'repositories';

        if (!is_null($owner)) {
            $endpoint = sprintf('repositories/%s', $owner);
        }

        return $this->getClient()->setApiVersion('2.0')->get($endpoint);
    }
}
