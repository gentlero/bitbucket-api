<?php

/*
 * This file is part of the bitbucket_api package.
 *
 * (c) Alexandru G. <alex@gentle.ro>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Bitbucket\API;

/**
 * Users class
 *
 * Get information related to an individual or team account.
 * NOTE: For making calls against the currently authenticated account, see the `User` resource.
 *
 * @author  Alexandru G.    <alex@gentle.ro>
 */
class Users extends Api
{
    /**
     * Get account
     *
     * @access public
     * @return Users\Account
     */
    public function account()
    {
        $account = new Users\Account( $this->client );

        if ( !is_null($this->auth) ) {
            $account->setCredentials( $this->auth );
        }

        return $account;
    }

    /**
     * Get emails
     *
     * @access public
     * @return Users\Emails
     */
    public function emails()
    {
        $emails = new Users\Emails( $this->client );

        if ( !is_null($this->auth) ) {
            $emails->setCredentials( $this->auth );
        }

        return $emails;
    }

    /**
     * Get invitations
     *
     * @access public
     * @return Users\Invitations
     */
    public function invitations()
    {
        $invitations = new Users\Invitations( $this->client );

        if ( !is_null($this->auth) ) {
            $invitations->setCredentials( $this->auth );
        }

        return $invitations;
    }

    /**
     * Get oauth
     *
     * @access public
     * @return Users\OAuth
     */
    public function oauth()
    {
        $oauth = new Users\OAuth( $this->client );

        if ( !is_null($this->auth) ) {
            $oauth->setCredentials( $this->auth );
        }

        return $oauth;
    }

    /**
     * Get privileges
     *
     * @access public
     * @return Users\Privileges
     */
    public function privileges()
    {
        $privileges = new Users\Privileges( $this->client );

        if ( !is_null($this->auth) ) {
            $privileges->setCredentials( $this->auth );
        }

        return $privileges;
    }

    /**
     * Get sshKeys
     *
     * @access public
     * @return Users\SshKeys
     */
    public function sshKeys()
    {
        $keys = new Users\SshKeys( $this->client );

        if ( !is_null($this->auth) ) {
            $keys->setCredentials( $this->auth );
        }

        return $keys;
    }
}