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
     * @codeCoverageIgnore
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
     * @codeCoverageIgnore
     */
    public function emails()
    {
        $emails = new Users\Emails( $this->client );

        if ( !is_null($this->auth) ) {
            $emails->setCredentials( $this->auth );
        }

        return $emails;
    }
}