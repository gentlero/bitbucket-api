<?php

namespace Bitbucket\Tests\API\Authentication;

use Bitbucket\Tests\API as Tests;
use Bitbucket\API\Authentication;

class BasicTest extends Tests\TestCase
{
    private $auth;

    public function setUp()
    {
        $this->auth = new Authentication\Basic('api_username', 'api_password');
    }

    public function testWrongCredentials()
    {
        $this->assertNotEquals('username', $this->auth->getUsername());
        $this->assertNotEquals('password', $this->auth->getPassword());
    }

    public function testSetUsername()
    {
        $this->auth->setUsername('username');
        $this->assertEquals('username', $this->auth->getUsername());
    }

    public function testSetGetPassword()
    {
        $this->auth->setPassword('password');
        $this->assertEquals('password', $this->auth->getPassword());
    }

    public function testAuthenticateWrongUsername()
    {
        $request = new \Buzz\Message\Request;
        $this->auth->authenticate($request);
        $this->auth->setUsername('wrong_username');

        $this->assertNotEquals('api_username', $this->auth->getUsername());
    }

    public function testAuthenticateWrongPassword()
    {
        $request = new \Buzz\Message\Request;
        $this->auth->authenticate($request);
        $this->auth->setPassword('wrong_password');

        $this->assertNotEquals('api_password', $this->auth->getPassword());
    }

    public function testAuthenticateSuccess()
    {
        $request = new \Buzz\Message\Request;
        $this->auth->authenticate($request);

        // check if header is set correctly
        $header = $request->getHeader('Authorization');
        $this->assertNotNull($header);

        // recover username and password from header data
        list(, $credentials) = explode(' ', $header);
        $pcs = explode(':', base64_decode($credentials));

        $this->assertEquals('api_username', $pcs[0]);
        $this->assertEquals('api_password', $pcs[1]);
    }
}
