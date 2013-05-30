<?php

/*
 * This file is part of the bitbucket-api package.
 *
 * (c) Alexandru G. <alex@gentle.ro>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Bitbucket\API;

/**
 * NewUser class
 *
 * Create an individual account on the Bitbucket service.
 * NOTE: The service throttles this call at 2 request per 30 minutes.
 *
 * @author  Alexandru G.    <alex@gentle.ro>
 */
class NewUser extends Api
{
    /**
     * @access public
     * @param  string $username The team or individual account name.
     * @param  string $email    The account's primary email address. This must be unique.
     * @param  string $name     The name of the user.
     * @param  string $password The user's password.
     * @return mixed
     */
    public function create($username, $email, $name, $password)
    {
        return $this->requestPost('newuser/',
            array(
                'username'  => $username,
                'email'     => $email,
                'name'      => $name,
                'password'  => $password
            )
        );
    }
}
