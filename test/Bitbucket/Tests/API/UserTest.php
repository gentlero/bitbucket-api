<?php

namespace Bitbucket\Tests\API\Repositories;

use Bitbucket\Tests\API as Tests;
use Bitbucket\API;

class UserTest extends Tests\TestCase
{
    public function testGetUserProfileSuccess()
    {
        $endpoint       = 'user/';
        $expectedResult = json_encode('dummy');

        $user = $this->getApiMock('\Bitbucket\API\User');
        $user->expects($this->once())
            ->method('requestGet')
            ->with($endpoint)
            ->will( $this->returnValue($expectedResult));

        /** @var $user \Bitbucket\API\User */
        $actual = $user->get();

        $this->assertEquals($expectedResult, $actual);
    }

    public function testUpdateUserSuccess()
    {
        $endpoint   = 'user/';
        $params     = array(
            'first_name'    => 'John',
            'last_name'     => 'Doe'
        );

        $user = $this->getApiMock('\Bitbucket\API\User');
        $user->expects($this->once())
            ->method('requestPut')
            ->with($endpoint, $params);

        /** @var $user \Bitbucket\API\User */
        $user->update($params);
    }

    public function testGetUserPrivilegesSuccess()
    {
        $endpoint       = 'user/privileges';
        $expectedResult = json_encode(array(
                'teams' => array(
                    'team1' => 'admin',
                    'team2' => 'admin'
                )
            ));

        $user = $this->getApiMock('\Bitbucket\API\User');
        $user->expects($this->once())
            ->method('requestGet')
            ->with($endpoint)
            ->will( $this->returnValue($expectedResult));

        /** @var $user \Bitbucket\API\User */
        $actual = $user->privileges();

        $this->assertEquals($expectedResult, $actual);
    }

    public function testGetUserRepositoriesFollowSuccess()
    {
        $endpoint       = 'user/follows';
        $expectedResult = json_encode('dummy');

        $user = $this->getApiMock('\Bitbucket\API\User');
        $user->expects($this->once())
            ->method('requestGet')
            ->with($endpoint)
            ->will( $this->returnValue($expectedResult));

        /** @var $user \Bitbucket\API\User */
        $actual = $user->follows();

        $this->assertEquals($expectedResult, $actual);
    }
}