<?php

namespace Bitbucket\Tests\API\Users;

use Bitbucket\Tests\API as Tests;
use Bitbucket\API;

class InvitationsTest extends Tests\TestCase
{
    public function testGetAllInvitations()
    {
        $endpoint       = 'users/gentle/invitations';
        $expectedResult = $this->addFakeResponse(json_encode('dummy'));

        /** @var $invitations \Bitbucket\API\Users\Invitations */
        $invitations = $this->getApiMock('Bitbucket\API\Users\Invitations');
        $actual = $invitations->all('gentle');

        $this->assertEquals($expectedResult, $actual);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('GET', $request->getMethod());
    }

    public function testGetInvitationsForEmailAddress()
    {
        $endpoint       = 'users/gentle/invitations/dummy@example.com';
        $expectedResult = $this->addFakeResponse(json_encode('dummy'));

        /** @var $invitations \Bitbucket\API\Users\Invitations */
        $invitations = $this->getApiMock('Bitbucket\API\Users\Invitations');
        $actual = $invitations->email('gentle', 'dummy@example.com');

        $this->assertEquals($expectedResult, $actual);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('GET', $request->getMethod());
    }

    public function testGetInvitationsForGroupMembership()
    {
        $endpoint       = 'users/gentle/invitations/dummy@example.com/john/testers';
        $expectedResult = $this->addFakeResponse(json_encode('dummy'));

        /** @var $invitations \Bitbucket\API\Users\Invitations */
        $invitations = $this->getApiMock('Bitbucket\API\Users\Invitations');
        $actual = $invitations->group('gentle', 'john', 'testers', 'dummy@example.com');

        $this->assertEquals($expectedResult, $actual);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('GET', $request->getMethod());
    }

    public function testIssuesNewInvitationSuccess()
    {
        $endpoint       = 'users/gentle/invitations/dummy@example.com/john/testers';
        $expectedResult = $this->addFakeResponse(json_encode('dummy'));

        /** @var $invitations \Bitbucket\API\Users\Invitations */
        $invitations = $this->getApiMock('Bitbucket\API\Users\Invitations');
        $actual = $invitations->create('gentle', 'john', 'testers', 'dummy@example.com');

        $this->assertEquals($expectedResult, $actual);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('PUT', $request->getMethod());
    }

    public function testDeleteInvitationByEmailSuccess()
    {
        $endpoint       = 'users/gentle/invitations/dummy@example.com';
        $expectedResult = $this->addFakeResponse(json_encode('dummy'));

        /** @var $invitations \Bitbucket\API\Users\Invitations */
        $invitations = $this->getApiMock('Bitbucket\API\Users\Invitations');
        $actual = $invitations->deleteByEmail('gentle', 'dummy@example.com');

        $this->assertEquals($expectedResult, $actual);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('DELETE', $request->getMethod());
    }

    public function testDeleteInvitationByGroupSuccess()
    {
        $endpoint       = 'users/gentle/invitations/dummy@example.com/john/testers';
        $expectedResult = $this->addFakeResponse(json_encode('dummy'));

        /** @var $invitations \Bitbucket\API\Users\Invitations */
        $invitations = $this->getApiMock('Bitbucket\API\Users\Invitations');
        $actual = $invitations->deleteByGroup('gentle', 'john', 'testers', 'dummy@example.com');

        $this->assertEquals($expectedResult, $actual);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('DELETE', $request->getMethod());
    }
}
