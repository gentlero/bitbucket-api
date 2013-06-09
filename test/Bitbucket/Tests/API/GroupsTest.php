<?php

namespace Bitbucket\Tests\API;

use Bitbucket\Tests\API as Tests;
use Bitbucket\API;

class GroupsTest extends Tests\TestCase
{
    public function testGetAllGroups()
    {
        $endpoint       = 'groups/gentle/';
        $expectedResult = json_encode('dummy');

        $groups = $this->getApiMock('Bitbucket\API\Groups');
        $groups->expects($this->once())
            ->method('requestGet')
            ->with($endpoint)
            ->will( $this->returnValue($expectedResult) );

        /** @var $groups \Bitbucket\API\Groups */
        $actual = $groups->get('gentle');

        $this->assertEquals($expectedResult, $actual);
    }

    public function testGetAllGroupsWithFilter()
    {
        $endpoint       = 'groups';
        $params         = array('group' => 'gentle/testers');
        $expectedResult = json_encode('dummy');

        $groups = $this->getApiMock('Bitbucket\API\Groups');
        $groups->expects($this->once())
            ->method('requestGet')
            ->with($endpoint, $params)
            ->will( $this->returnValue($expectedResult) );

        /** @var $groups \Bitbucket\API\Groups */
        $actual = $groups->get('gentle', $params);

        $this->assertEquals($expectedResult, $actual);
    }

    public function testCreateGroupSuccess()
    {
        $endpoint       = 'groups/gentle/';
        $params         = array(
            'name'  => 'testers'
        );

        $groups = $this->getApiMock('Bitbucket\API\Groups');
        $groups->expects($this->once())
            ->method('requestPost')
            ->with($endpoint, $params);

        /** @var $groups \Bitbucket\API\Groups */
        $groups->create('gentle', 'testers');
    }

    public function testUpdateGroupSuccess()
    {
        $endpoint       = 'groups/gentle/dummy/';
        $params         = array(
            'accountname'   => 'gentle',
            'name'          => 'Dummy group'
        );

        $group = $this->getApiMock('Bitbucket\API\Groups');
        $group->expects($this->once())
            ->method('requestPut')
            ->with($endpoint, $params);

        /** @var $group \Bitbucket\API\Groups */
        $group->update('gentle', 'dummy', $params);
    }

    public function testDeleteGroupSuccess()
    {
        $endpoint       = 'groups/gentle/dummy/';

        $groups = $this->getApiMock('Bitbucket\API\Groups');
        $groups->expects($this->once())
            ->method('requestDelete')
            ->with($endpoint);

        /** @var $groups \Bitbucket\API\Groups */
        $groups->delete('gentle', 'dummy');
    }
}