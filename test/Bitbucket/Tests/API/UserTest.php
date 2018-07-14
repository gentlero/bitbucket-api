<?php

namespace Bitbucket\Tests\API\Repositories;

use Bitbucket\Tests\API as Tests;
use Bitbucket\API;

class UserTest extends Tests\TestCase
{
    public function testGetEmails()
    {
        $endpoint       = 'user/emails';
        $expectedResult = $this->addFakeResponse(array('dummy'));

        /** @var \Bitbucket\API\User $user */
        $user = $this->getApiMock('Bitbucket\API\User');
        $actual = $user->emails();

        $this->assertEquals($expectedResult, $actual);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/2.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('GET', $request->getMethod());
    }

    public function testGetUserProfileSuccess()
    {
        $endpoint       = 'user/';
        $expectedResult = $this->addFakeResponse(json_encode('dummy'));

        /** @var \Bitbucket\API\User $user */
        $user = $this->getApiMock('Bitbucket\API\User');
        $actual = $user->get();

        $this->assertEquals($expectedResult, $actual);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('GET', $request->getMethod());
    }

    public function testUpdateUserSuccess()
    {
        $endpoint   = 'user/';
        $params     = array(
            'first_name'    => 'John',
            'last_name'     => 'Doe'
        );

        /** @var $user \Bitbucket\API\User */
        $user = $this->getApiMock('\Bitbucket\API\User');

        $user->update($params);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('PUT', $request->getMethod());
        $this->assertSame('first_name=John&last_name=Doe', $request->getBody()->getContents());
    }

    public function testGetUserPrivilegesSuccess()
    {
        $endpoint       = 'user/privileges';
        $expectedResult = $this->addFakeResponse(json_encode(array(
            'teams' => array(
                'team1' => 'admin',
                'team2' => 'admin'
            )
        )));

        /** @var $user \Bitbucket\API\User */
        $user = $this->getApiMock('\Bitbucket\API\User');

        $actual = $user->privileges();

        $this->assertEquals($expectedResult, $actual);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('GET', $request->getMethod());
    }

    public function testGetUserRepositoriesFollowSuccess()
    {
        $endpoint       = 'user/follows';
        $expectedResult = $this->addFakeResponse(json_encode('dummy'));

        /** @var $user \Bitbucket\API\User */
        $user = $this->getApiMock('\Bitbucket\API\User');

        $actual = $user->follows();

        $this->assertEquals($expectedResult, $actual);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('GET', $request->getMethod());
    }
}
