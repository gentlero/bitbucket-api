<?php

/**
 * This file is part of the bitbucket-api package.
 *
 * (c) Alexandru G. <alex@gentle.ro>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Bitbucket\API\Authentication;

use Buzz\Message\RequestInterface;

/**
 * Basic Authentication
 *
 * @author  Alexandru G.    <alex@gentle.ro>
 */
class Basic implements AuthenticationInterface
{
    /**
     * Username
     * @var string
     */
    private $username;

    /**
     * Password
     * @var string
     */
    private $password;

    /**
     * @param string $username API Username
     * @param string $password API Password
     */
    public function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * Set username
     *
     * @access public
     * @param  string $username
     * @return void
     */
    public function setUsername($username)
    {
        $this->username = sprintf('%s', $username);
    }

    /**
     * Get current username
     *
     * @access public
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set password
     *
     * @access public
     * @param  string $password
     * @return void
     */
    public function setPassword($password)
    {
        $this->password = sprintf('%s', $password);
    }

    /**
     * Get current password
     *
     * @access public
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * {@inheritdoc}
     */
    public function authenticate(RequestInterface $request)
    {
        $request->addHeader('Authorization: Basic ' . base64_encode($this->username . ':' . $this->password));

        return $request;
    }
}
