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
}