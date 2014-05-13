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
 * Get information related to an individual or team account.
 * NOTE: For making calls against the currently authenticated account, see the `User` resource.
 *
 * @author  Alexandru G.    <alex@gentle.ro>
 */
class Users extends Api
{
    /**
     * Get the public information associated with a user
     *
     * @access public
     * @param  string           $username
     * @return MessageInterface
     */
    public function get($username)
    {
        return $this->getClient()->setApiVersion('2.0')->get(
            sprintf('users/%s', $username)
        );
    }

    /**
     * Get the list of followers.
     *
     * @access public
     * @param  string           $username
     * @return MessageInterface
     */
    public function followers($username)
    {
        return $this->getClient()->setApiVersion('2.0')->get(
            sprintf('users/%s/followers', $username)
        );
    }

    /**
     * Get a list of accounts the user is following
     *
     * @access public
     * @param  string           $username
     * @return MessageInterface
     */
    public function following($username)
    {
        return $this->getClient()->setApiVersion('2.0')->get(
            sprintf('users/%s/following', $username)
        );
    }

    /**
     * Get the list of the user's repositories
     *
     * @access public
     * @param  string           $username
     * @return MessageInterface
     */
    public function repositories($username)
    {
        return $this->getClient()->setApiVersion('2.0')->get(
            sprintf('repositories/%s', $username)
        );
    }

    /**
     * Get account
     *
     * @access public
     * @return Users\Account
     */
    public function account()
    {
        return $this->childFactory('Users\\Account');
    }

    /**
     * Get emails
     *
     * @access public
     * @return Users\Emails
     */
    public function emails()
    {
        return $this->childFactory('Users\\Emails');
    }

    /**
     * Get invitations
     *
     * @access public
     * @return Users\Invitations
     */
    public function invitations()
    {
        return $this->childFactory('Users\\Invitations');
    }

    /**
     * Get oauth
     *
     * @access public
     * @return Users\OAuth
     */
    public function oauth()
    {
        return $this->childFactory('Users\\OAuth');
    }

    /**
     * Get privileges
     *
     * @access public
     * @return Users\Privileges
     */
    public function privileges()
    {
        return $this->childFactory('Users\\Privileges');
    }

    /**
     * Get sshKeys
     *
     * @access public
     * @return Users\SshKeys
     */
    public function sshKeys()
    {
        return $this->childFactory('Users\\SshKeys');
    }
}
