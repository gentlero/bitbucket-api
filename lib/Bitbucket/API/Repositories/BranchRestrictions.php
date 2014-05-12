<?php

/**
 * This file is part of the bitbucket-api package.
 *
 * (c) Alexandru G. <alex@gentle.ro>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Bitbucket\API\Repositories;

use Bitbucket\API\Api;
use Buzz\Message\MessageInterface;

/**
 * Manage branch restrictions on a repository
 *
 * @author  Alexandru G.    <alex@gentle.ro>
 */
class BranchRestrictions extends Api
{
    /**
     * Get the information associated with a repository's branch restrictions
     *
     * @access public
     * @param  string           $account The team or individual account owning the repository.
     * @param  string           $repo    The repository identifier.
     * @return MessageInterface
     */
    public function all($account, $repo)
    {
        return $this->getClient()->setApiVersion('2.0')->get(
            sprintf('repositories/%s/%s/branch-restrictions', $account, $repo)
        );
    }
}
