<?php

namespace Bitbucket\Tests\API\Users;

use Bitbucket\Tests\API as Tests;
use Bitbucket\API;

class InvitationsTest extends Tests\TestCase
{
    public function testGetAllInvitations()
    {
        $endpoint       = 'users/gentle/invitations';
        $expectedResult = json_encode('dummy');

        $invitations = $this->getApiMock('Bitbucket\API\Users\Invitations');
        $invitations->expects($this->once())
            ->method('requestGet')
            ->with($endpoint)
            ->will( $this->returnValue($expectedResult) );

        /** @var $invitations \Bitbucket\API\Users\Invitations */
        $actual = $invitations->all('gentle');

        $this->assertEquals($expectedResult, $actual);
    }

    public function testGetInvitationsForEmailAddress()
    {
        $endpoint       = 'users/gentle/invitations/dummy@example.com';
        $expectedResult = json_encode('dummy');

        $invitations = $this->getApiMock('Bitbucket\API\Users\Invitations');
        $invitations->expects($this->once())
            ->method('requestGet')
            ->with($endpoint)
            ->will( $this->returnValue($expectedResult) );

        /** @var $invitations \Bitbucket\API\Users\Invitations */
        $actual = $invitations->email('gentle', 'dummy@example.com');

        $this->assertEquals($expectedResult, $actual);
    }

    public function testGetInvitationsForGroupMembership()
    {
        $endpoint       = 'users/gentle/invitations/dummy@example.com/john/testers';
        $expectedResult = json_encode('dummy');

        $invitations = $this->getApiMock('Bitbucket\API\Users\Invitations');
        $invitations->expects($this->once())
            ->method('requestGet')
            ->with($endpoint)
            ->will( $this->returnValue($expectedResult) );

        /** @var $invitations \Bitbucket\API\Users\Invitations */
        $actual = $invitations->group('gentle', 'john', 'testers', 'dummy@example.com');

        $this->assertEquals($expectedResult, $actual);
    }

    public function testIssuesNewInvitationSuccess()
    {
        $endpoint       = 'users/gentle/invitations/dummy@example.com/john/testers';
        $expectedResult = json_encode('dummy');

        $invitations = $this->getApiMock('Bitbucket\API\Users\Invitations');
        $invitations->expects($this->once())
            ->method('requestPut')
            ->with($endpoint)
            ->will( $this->returnValue($expectedResult) );

        /** @var $invitations \Bitbucket\API\Users\Invitations */
        $actual = $invitations->create('gentle', 'john', 'testers', 'dummy@example.com');

        $this->assertEquals($expectedResult, $actual);
    }

    public function testDeleteInvitationByEmailSuccess()
    {
        $endpoint       = 'users/gentle/invitations/dummy@example.com';
        $expectedResult = json_encode('dummy');

        $invitations = $this->getApiMock('Bitbucket\API\Users\Invitations');
        $invitations->expects($this->once())
            ->method('requestDelete')
            ->with($endpoint)
            ->will( $this->returnValue($expectedResult) );

        /** @var $invitations \Bitbucket\API\Users\Invitations */
        $actual = $invitations->deleteByEmail('gentle', 'dummy@example.com');

        $this->assertEquals($expectedResult, $actual);
    }

    public function testDeleteInvitationByGroupSuccess()
    {
        $endpoint       = 'users/gentle/invitations/dummy@example.com/john/testers';
        $expectedResult = json_encode('dummy');

        $invitations = $this->getApiMock('Bitbucket\API\Users\Invitations');
        $invitations->expects($this->once())
            ->method('requestDelete')
            ->with($endpoint)
            ->will( $this->returnValue($expectedResult) );

        /** @var $invitations \Bitbucket\API\Users\Invitations */
        $actual = $invitations->deleteByGroup('gentle', 'john', 'testers', 'dummy@example.com');

        $this->assertEquals($expectedResult, $actual);
    }
}