<?php

namespace Bitbucket\Tests\API;

use Bitbucket\Tests\API as Tests;

class TeamsTest extends Tests\TestCase
{
    public function testGetTeamProfile()
    {
        $endpoint       = 'teams/gentle-web';
        $expectedResult = $this->fakeResponse(array('dummy'));

        $client = $this->getHttpClientMock();
        $client->expects($this->once())
            ->method('get')
            ->with($endpoint)
            ->will($this->returnValue($expectedResult));

        /** @var \Bitbucket\API\Teams $team */
        $team   = $this->getClassMock('Bitbucket\API\Teams', $client);
        $actual = $team->profile('gentle-web');

        $this->assertEquals($expectedResult, $actual);
    }

    public function testGetTeamMembers()
    {
        $endpoint       = 'teams/gentle-web/members';
        $expectedResult = $this->fakeResponse(array('dummy'));

        $client = $this->getHttpClientMock();
        $client->expects($this->once())
            ->method('get')
            ->with($endpoint)
            ->will($this->returnValue($expectedResult));

        /** @var \Bitbucket\API\Teams $team */
        $team   = $this->getClassMock('Bitbucket\API\Teams', $client);
        $actual = $team->members('gentle-web');

        $this->assertEquals($expectedResult, $actual);
    }

    public function testGetTeamFollowers()
    {
        $endpoint       = 'teams/gentle-web/followers';
        $expectedResult = $this->fakeResponse(array('dummy'));

        $client = $this->getHttpClientMock();
        $client->expects($this->once())
            ->method('get')
            ->with($endpoint)
            ->will($this->returnValue($expectedResult));

        /** @var \Bitbucket\API\Teams $team */
        $team   = $this->getClassMock('Bitbucket\API\Teams', $client);
        $actual = $team->followers('gentle-web');

        $this->assertEquals($expectedResult, $actual);
    }

    public function testGetTeamFollowing()
    {
        $endpoint       = 'teams/gentle-web/following';
        $expectedResult = $this->fakeResponse(array('dummy'));

        $client = $this->getHttpClientMock();
        $client->expects($this->once())
            ->method('get')
            ->with($endpoint)
            ->will($this->returnValue($expectedResult));

        /** @var \Bitbucket\API\Teams $team */
        $team   = $this->getClassMock('Bitbucket\API\Teams', $client);
        $actual = $team->following('gentle-web');

        $this->assertEquals($expectedResult, $actual);
    }

    public function testGetTeamRepositories()
    {
        $endpoint       = 'teams/gentle-web/repositories';
        $expectedResult = $this->fakeResponse(array('dummy'));

        $client = $this->getHttpClientMock();
        $client->expects($this->once())
            ->method('get')
            ->with($endpoint)
            ->will($this->returnValue($expectedResult));

        /** @var \Bitbucket\API\Teams $team */
        $team   = $this->getClassMock('Bitbucket\API\Teams', $client);
        $actual = $team->repositories('gentle-web');

        $this->assertEquals($expectedResult, $actual);
    }
}
