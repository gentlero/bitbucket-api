<?php

namespace Bitbucket\Tests\API\Repositories;

use Bitbucket\Tests\API as Tests;
use Bitbucket\API;
use Http\Message\Authentication\BasicAuth;

class UsersTest extends Tests\TestCase
{
    /**
     * @var API\Users
     */
    private $users;

    public function setUp()
    {
        $this->users = new API\Users();
        $this->users->setCredentials(
            new BasicAuth('dummy', 'password')
        );
    }

    public function testGetUserPublicInformation()
    {
        $endpoint       = 'users/john-doe';
        $expectedResult = $this->addFakeResponse(array('dummy'));

        /** @var \Bitbucket\API\Users $user */
        $user   = $this->getApiMock('Bitbucket\API\Users');
        $actual = $user->get('john-doe');

        $this->assertEquals($expectedResult, $actual);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/2.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('GET', $request->getMethod());
    }

    public function testGetUserFollowers()
    {
        $endpoint       = 'users/john-doe/followers';
        $expectedResult = $this->addFakeResponse(array('dummy'));

        /** @var \Bitbucket\API\Users $user */
        $user   = $this->getApiMock('Bitbucket\API\Users');
        $actual = $user->followers('john-doe');

        $this->assertEquals($expectedResult, $actual);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/2.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('GET', $request->getMethod());
    }

    public function testGetUserFollowing()
    {
        $endpoint       = 'users/john-doe/following';
        $expectedResult = $this->addFakeResponse(array('dummy'));

        /** @var \Bitbucket\API\Users $user */
        $user   = $this->getApiMock('Bitbucket\API\Users');
        $actual = $user->following('john-doe');

        $this->assertEquals($expectedResult, $actual);


        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/2.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('GET', $request->getMethod());
    }

    public function testGetUserRepositories()
    {
        $endpoint       = 'repositories/john-doe';
        $expectedResult = $this->addFakeResponse(array('dummy'));

        /** @var \Bitbucket\API\Users $user */
        $user   = $this->getApiMock('Bitbucket\API\Users');
        $actual = $user->repositories('john-doe');

        $this->assertEquals($expectedResult, $actual);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/2.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('GET', $request->getMethod());
    }

    public function testGetAccountInstance()
    {
        $this->assertInstanceOf('\Bitbucket\API\Users\Account', $this->users->account());
    }

    public function testGetEmailsInstance()
    {
        $this->assertInstanceOf('\Bitbucket\API\Users\Emails', $this->users->emails());
    }

    public function testGetInvitationsInstance()
    {
        $this->assertInstanceOf('\Bitbucket\API\Users\Invitations', $this->users->invitations());
    }

    public function testGetOAuthInstance()
    {
        $this->assertInstanceOf('\Bitbucket\API\Users\OAuth', $this->users->oauth());
    }

    public function testGetPrivilegesInstance()
    {
        $this->assertInstanceOf('\Bitbucket\API\Users\Privileges', $this->users->privileges());
    }

    public function testGetSshKeysInstance()
    {
        $this->assertInstanceOf('\Bitbucket\API\Users\SshKeys', $this->users->sshKeys());
    }
}
