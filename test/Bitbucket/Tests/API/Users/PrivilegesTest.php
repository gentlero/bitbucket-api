<?php

namespace Bitbucket\Tests\API\Users;

use Bitbucket\Tests\API as Tests;
use Bitbucket\API;

class PrivilegesTest extends Tests\TestCase
{
    public function testGetPrivilegeGroupsOnTeam()
    {
        $endpoint       = 'users/gentle/privileges';
        $expectedResult = $this->addFakeResponse(json_encode('dummy'));

        /** @var $privileges \Bitbucket\API\Users\Privileges */
        $privileges = $this->getApiMock('Bitbucket\API\Users\Privileges');
        $actual = $privileges->team('gentle');

        $this->assertEquals($expectedResult, $actual);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('GET', $request->getMethod());
    }

    public function testGetPrivilegeGroupsOnGroup()
    {
        $endpoint       = 'users/gentle/privileges/john/testers';
        $expectedResult = $this->addFakeResponse(json_encode('dummy'));

        /** @var $privileges \Bitbucket\API\Users\Privileges */
        $privileges = $this->getApiMock('Bitbucket\API\Users\Privileges');
        $actual = $privileges->group('gentle', 'john', 'testers');

        $this->assertEquals($expectedResult, $actual);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('GET', $request->getMethod());
    }

    public function testUpdateGroupPrivilege()
    {
        $endpoint       = 'users/gentle/privileges/john/testers';
        $expectedResult = $this->addFakeResponse(json_encode('dummy'));

        /** @var $privileges \Bitbucket\API\Users\Privileges */
        $privileges = $this->getApiMock('Bitbucket\API\Users\Privileges');
        $actual = $privileges->update('gentle', 'john', 'testers', 'admin');

        $this->assertEquals($expectedResult, $actual);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('PUT', $request->getMethod());
        $this->assertSame('privileges=admin', $request->getBody()->getContents());
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
        $expectedResult = $this->addFakeResponse(json_encode('dummy'));

        /** @var $privileges \Bitbucket\API\Users\Privileges */
        $privileges = $this->getApiMock('Bitbucket\API\Users\Privileges');
        $actual = $privileges->create('gentle', 'john', 'testers', 'admin');

        $this->assertEquals($expectedResult, $actual);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('POST', $request->getMethod());
        $this->assertSame('privileges=admin', $request->getBody()->getContents());
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
        $expectedResult = $this->addFakeResponse(json_encode('dummy'));

        /** @var $privileges \Bitbucket\API\Users\Privileges */
        $privileges = $this->getApiMock('Bitbucket\API\Users\Privileges');
        $actual = $privileges->delete('gentle', 'john', 'testers');

        $this->assertEquals($expectedResult, $actual);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('DELETE', $request->getMethod());
    }
}
