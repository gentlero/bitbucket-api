<?php

namespace Bitbucket\Tests\API\Groups;

use Bitbucket\Tests\API as Tests;
use Bitbucket\API;

class MembersTest extends Tests\TestCase
{
    public function testGetAllGroupMembers()
    {
        $endpoint       = 'groups/gentle/testers/members';
        $expectedResult = json_encode('dummy');

        $members = $this->getApiMock('Bitbucket\API\Groups\Members');
        $members->expects($this->once())
            ->method('requestGet')
            ->with($endpoint)
            ->will( $this->returnValue($expectedResult) );

        /** @var $members \Bitbucket\API\Groups\Members */
        $actual = $members->all('gentle', 'testers');

        $this->assertEquals($expectedResult, $actual);
    }

    public function testAddMemberToGroupSuccess()
    {
        $endpoint       = 'groups/gentle/testers/members/steve';

        $member = $this->getApiMock('Bitbucket\API\Groups\Members');
        $member->expects($this->once())
            ->method('requestPut')
            ->with($endpoint);

        /** @var $member \Bitbucket\API\Groups\Members */
        $member->add('gentle', 'testers', 'steve');
    }

    public function testDeleteMemberFromGroupSuccess()
    {
        $endpoint       = 'groups/gentle/testers/members/steve';

        $member = $this->getApiMock('Bitbucket\API\Groups\Members');
        $member->expects($this->once())
            ->method('requestDelete')
            ->with($endpoint);

        /** @var $member \Bitbucket\API\Groups\Members */
        $member->delete('gentle', 'testers', 'steve');
    }
}