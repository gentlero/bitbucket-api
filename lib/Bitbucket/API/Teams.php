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
     * Get a list of teams to which the caller has access.
     *
     * @access public
     * @param  string           $role Will only return teams on which the user has the specified role.
     * @return MessageInterface
     *
     * @throws \InvalidArgumentException
     */
    public function all($role)
    {
        if (!is_string($role)) {
            throw new \InvalidArgumentException(sprintf('Expected $role of type string and got %s', gettype($role)));
        }

        if (!in_array(strtolower($role), array('member', 'contributor', 'admin'), true)) {
            throw new \InvalidArgumentException(sprintf('Unknown role %s', $role));
        }

        return $this->getClient()->setApiVersion('2.0')->get('teams', array('role' => $role));
    }

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

    /**
     * Get the team followers list.
     *
     * @access public
     * @param  string           $name The team's name.
     * @return MessageInterface
     */
    public function followers($name)
    {
        return $this->getClient()->setApiVersion('2.0')->get(
            sprintf('teams/%s/followers', $name)
        );
    }

    /**
     * Get a list of accounts the team is following.
     *
     * @access public
     * @param  string           $name The team's name.
     * @return MessageInterface
     */
    public function following($name)
    {
        return $this->getClient()->setApiVersion('2.0')->get(
            sprintf('teams/%s/following', $name)
        );
    }

    /**
     * Get the team's repositories.
     *
     * @access public
     * @param  string           $name The team's name.
     * @return MessageInterface
     */
    public function repositories($name)
    {
        return $this->getClient()->setApiVersion('2.0')->get(
            sprintf('teams/%s/repositories', $name)
        );
    }
}
