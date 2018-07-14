<?php

namespace Bitbucket\Tests\API\Groups;

use Bitbucket\Tests\API as Tests;
use Bitbucket\API;

class MembersTest extends Tests\TestCase
{
    public function testGetAllGroupMembers()
    {
        $endpoint       = 'groups/gentle/testers/members';
        $expectedResult = $this->addFakeResponse(json_encode('dummy'));

        /** @var $members \Bitbucket\API\Groups\Members */
        $members = $this->getApiMock('Bitbucket\API\Groups\Members');
        $actual = $members->all('gentle', 'testers');

        $this->assertEquals($expectedResult, $actual);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('GET', $request->getMethod());
    }

    public function testAddMemberToGroupSuccess()
    {
        $endpoint       = 'groups/gentle/testers/members/steve';

        /** @var $member \Bitbucket\API\Groups\Members */
        $member = $this->getApiMock('Bitbucket\API\Groups\Members');

        $member->add('gentle', 'testers', 'steve');

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('PUT', $request->getMethod());
    }

    public function testDeleteMemberFromGroupSuccess()
    {
        $endpoint       = 'groups/gentle/testers/members/steve';

        /** @var $member \Bitbucket\API\Groups\Members */
        $member = $this->getApiMock('Bitbucket\API\Groups\Members');

        $member->delete('gentle', 'testers', 'steve');

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('DELETE', $request->getMethod());
    }
}
