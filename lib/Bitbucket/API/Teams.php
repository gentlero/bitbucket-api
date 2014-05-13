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
class Teams extends Api
{
    /**
     * Get the public information associated with a team.
     *
     * @access public
     * @param  string           $name The team's name.
     * @return MessageInterface
     */
    public function profile($name)
    {
        return $this->getClient()->setApiVersion('2.0')->get(
            sprintf('teams/%s', $name)
        );
    }

    /**
     * Get the team members.
     *
     * @access public
     * @param  string           $name The team's name.
     * @return MessageInterface
     */
    public function members($name)
    {
        return $this->getClient()->setApiVersion('2.0')->get(
            sprintf('teams/%s/members', $name)
        );
    }
}
