<?php

namespace Bitbucket\Tests\API;

use Bitbucket\Tests\API as Tests;
use Bitbucket\API;

class NewUserTest extends Tests\TestCase
{
    public function testCreateAccountSuccess()
    {
        $endpoint       = 'newuser/';
        $params         = array(
            'username'  => 'john',
            'email'     => 'dummy@example.com',
            'name'      => 'John Doe',
            'password'  => 'secret'
        );

        $newuser = $this->getApiMock('Bitbucket\API\NewUser');
        $newuser->expects($this->once())
            ->method('requestPost')
            ->with($endpoint, $params);

        /** @var $newuser \Bitbucket\API\NewUser */
        $newuser->create($params['username'], $params['email'], $params['name'], $params['password']);
    }
}