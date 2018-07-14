<?php

namespace Bitbucket\Tests\API;

use Bitbucket\Tests\API as Tests;

class TeamsTest extends Tests\TestCase
{
    public function invalidRoleProvider()
    {
        return array(
            array('invalid'),
            array(2),
            array(array('invalid')),
            array('2.0'),
            array(true),
            array(array('admin')),
            array(array())
        );
    }

    /**
     * @dataProvider invalidRoleProvider
     * @expectedException \InvalidArgumentException
     */
    public function testGetTeamsListWithInvalidRole($role)
    {
        /** @var \Bitbucket\API\Teams $team */
        $team = $this->getApiMock('Bitbucket\API\Teams');
        $team->all($role);
    }

    public function testGetTeamsList()
    {
        $endpoint       = 'teams';
        $expectedResult = $this->addFakeResponse(array('dummy'));

        /** @var \Bitbucket\API\Teams $team */
        $team = $this->getApiMock('Bitbucket\API\Teams');
        $actual = $team->all('member');

        $this->assertEquals($expectedResult, $actual);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/2.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('GET', $request->getMethod());
    }

    public function testGetTeamProfile()
    {
        $endpoint       = 'teams/gentle-web';
        $expectedResult = $this->addFakeResponse(array('dummy'));


        /** @var \Bitbucket\API\Teams $team */
        $team   = $this->getApiMock('Bitbucket\API\Teams');
        $actual = $team->profile('gentle-web');

        $this->assertEquals($expectedResult, $actual);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/2.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('GET', $request->getMethod());
    }

    public function testGetTeamMembers()
    {
        $endpoint       = 'teams/gentle-web/members';
        $expectedResult = $this->addFakeResponse(array('dummy'));

        /** @var \Bitbucket\API\Teams $team */
        $team   = $this->getApiMock('Bitbucket\API\Teams');
        $actual = $team->members('gentle-web');

        $this->assertEquals($expectedResult, $actual);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/2.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('GET', $request->getMethod());
    }

    public function testGetTeamFollowers()
    {
        $endpoint       = 'teams/gentle-web/followers';
        $expectedResult = $this->addFakeResponse(array('dummy'));

        /** @var \Bitbucket\API\Teams $team */
        $team   = $this->getApiMock('Bitbucket\API\Teams');
        $actual = $team->followers('gentle-web');

        $this->assertEquals($expectedResult, $actual);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/2.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('GET', $request->getMethod());
    }

    public function testGetTeamFollowing()
    {
        $endpoint       = 'teams/gentle-web/following';
        $expectedResult = $this->addFakeResponse(array('dummy'));

        /** @var \Bitbucket\API\Teams $team */
        $team   = $this->getApiMock('Bitbucket\API\Teams');
        $actual = $team->following('gentle-web');

        $this->assertEquals($expectedResult, $actual);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/2.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('GET', $request->getMethod());
    }

    public function testGetTeamRepositories()
    {
        $endpoint       = 'teams/gentle-web/repositories';
        $expectedResult = $this->addFakeResponse(array('dummy'));

        /** @var \Bitbucket\API\Teams $team */
        $team   = $this->getApiMock('Bitbucket\API\Teams');
        $actual = $team->repositories('gentle-web');

        $this->assertEquals($expectedResult, $actual);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/2.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('GET', $request->getMethod());
    }
}
