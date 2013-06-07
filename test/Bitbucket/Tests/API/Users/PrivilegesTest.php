<?php

namespace Bitbucket\Tests\API\Users;

use Bitbucket\Tests\API as Tests;
use Bitbucket\API;

class PrivilegesTest extends Tests\TestCase
{
    public function testGetPrivilegeGroupsOnTeam()
    {
        $endpoint       = 'users/gentle/privileges';
        $expectedResult = json_encode('dummy');

        $privileges = $this->getApiMock('Bitbucket\API\Users\Privileges');
        $privileges->expects($this->once())
            ->method('requestGet')
            ->with($endpoint)
            ->will( $this->returnValue($expectedResult) );

        /** @var $privileges \Bitbucket\API\Users\Privileges */
        $actual = $privileges->team('gentle');

        $this->assertEquals($expectedResult, $actual);
    }

    public function testGetPrivilegeGroupsOnGroup()
    {
        $endpoint       = 'users/gentle/privileges/john/testers';
        $expectedResult = json_encode('dummy');

        $privileges = $this->getApiMock('Bitbucket\API\Users\Privileges');
        $privileges->expects($this->once())
            ->method('requestGet')
            ->with($endpoint)
            ->will( $this->returnValue($expectedResult) );

        /** @var $privileges \Bitbucket\API\Users\Privileges */
        $actual = $privileges->group('gentle', 'john', 'testers');

        $this->assertEquals($expectedResult, $actual);
    }

    public function testUpdateGroupPrivilege()
    {
        $endpoint       = 'users/gentle/privileges/john/testers';
        $expectedResult = json_encode('dummy');
        $params         = array('privileges' => 'admin');

        $privileges = $this->getApiMock('Bitbucket\API\Users\Privileges');
        $privileges->expects($this->once())
            ->method('requestPut')
            ->with($endpoint, $params)
            ->will( $this->returnValue($expectedResult) );

        /** @var $privileges \Bitbucket\API\Users\Privileges */
        $actual = $privileges->update('gentle', 'john', 'testers', 'admin');

        $this->assertEquals($expectedResult, $actual);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testUpdateGroupPrivilegeInvalidPrivilege()
    {
        $privileges = $this->getApiMock('Bitbucket\API\Users\Privileges');

        /** @var $privileges \Bitbucket\API\Users\Privileges */
        $privileges->update('gentle', 'john', 'testers', 'invalid');
    }

    public function testCreateGroupPrivilege()
    {
        $endpoint       = 'users/gentle/privileges/john/testers';
        $expectedResult = json_encode('dummy');
        $params         = array('privileges' => 'admin');

        $privileges = $this->getApiMock('Bitbucket\API\Users\Privileges');
        $privileges->expects($this->once())
            ->method('requestPost')
            ->with($endpoint, $params)
            ->will( $this->returnValue($expectedResult) );

        /** @var $privileges \Bitbucket\API\Users\Privileges */
        $actual = $privileges->create('gentle', 'john', 'testers', 'admin');

        $this->assertEquals($expectedResult, $actual);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testCreateGroupPrivilegeInvalidPrivilege()
    {
        $privileges = $this->getApiMock('Bitbucket\API\Users\Privileges');

        /** @var $privileges \Bitbucket\API\Users\Privileges */
        $privileges->create('gentle', 'john', 'testers', 'invalid');
    }

    public function testDeleteGroupPrivilege()
    {
        $endpoint       = 'users/gentle/privileges/john/testers';
        $expectedResult = json_encode('dummy');

        $privileges = $this->getApiMock('Bitbucket\API\Users\Privileges');
        $privileges->expects($this->once())
            ->method('requestDelete')
            ->with($endpoint)
            ->will( $this->returnValue($expectedResult) );

        /** @var $privileges \Bitbucket\API\Users\Privileges */
        $actual = $privileges->delete('gentle', 'john', 'testers');

        $this->assertEquals($expectedResult, $actual);
    }
}