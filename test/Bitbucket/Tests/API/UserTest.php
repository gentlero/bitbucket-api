<?php

namespace Bitbucket\Tests\API\Repositories;

use Bitbucket\Tests\API as Tests;
use Bitbucket\API;

class UserTest extends Tests\TestCase
{
    public function testGetEmails()
    {
        $endpoint       = 'user/emails';
        $expectedResult = $this->fakeResponse(array('dummy'));

        $client = $this->getHttpClientMock();
        $client->expects($this->any())
            ->method('get')
            ->with($endpoint)
            ->will($this->returnValue($expectedResult));

        /** @var \Bitbucket\API\User $user */
        $user = $this->getClassMock('Bitbucket\API\User', $client);
        $actual = $user->emails();

        $this->assertEquals($expectedResult, $actual);
    }

    public function testGetUserProfileSuccess()
    {
        $endpoint       = 'user/';
        $expectedResult = json_encode('dummy');

        $client = $this->getHttpClientMock();
        $client->expects($this->any())
            ->method('get')
            ->with($endpoint)
            ->will($this->returnValue($expectedResult));

        /** @var \Bitbucket\API\User $user */
        $user = $this->getClassMock('Bitbucket\API\User', $client);
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
