<?php

namespace Bitbucket\Tests\API;

use Bitbucket\Tests\API as Tests;
use Bitbucket\API;

class GroupPrivilegesTest extends Tests\TestCase
{
    public function testGetGroupsPrivilegesSuccess()
    {
        $endpoint       = 'group-privileges/gentle/';

        $privileges = $this->getApiMock('Bitbucket\API\GroupPrivileges');

        /** @var $privileges \Bitbucket\API\GroupPrivileges */
        $privileges->groups('gentle');

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('GET', $request->getMethod());
    }

    public function testGetRepositoryPrivilegesSuccess()
    {
        $endpoint       = 'group-privileges/gentle/dummy-repo';

        $privileges = $this->getApiMock('Bitbucket\API\GroupPrivileges');

        /** @var $privileges \Bitbucket\API\GroupPrivileges */
        $privileges->repository('gentle', 'dummy-repo');

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('GET', $request->getMethod());
    }

    public function testGetGroupPrivilegesSuccess()
    {
        $endpoint       = 'group-privileges/gentle/dummy-repo/owner/testers';

        $privileges = $this->getApiMock('Bitbucket\API\GroupPrivileges');

        /** @var $privileges \Bitbucket\API\GroupPrivileges */
        $privileges->group('gentle', 'dummy-repo', 'owner', 'testers');

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('GET', $request->getMethod());
    }

    public function testGetRepositoriesPrivilegeGroupSuccess()
    {
        $endpoint       = 'group-privileges/gentle/owner/testers';

        $privileges = $this->getApiMock('Bitbucket\API\GroupPrivileges');

        /** @var $privileges \Bitbucket\API\GroupPrivileges */
        $privileges->repositories('gentle', 'owner', 'testers');

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('GET', $request->getMethod());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testGrantGroupPrivilegesInvalidPrivilege()
    {
        $privileges = $this->getApiMock('Bitbucket\API\GroupPrivileges');

        /** @var $privileges \Bitbucket\API\GroupPrivileges */
        $privileges->grant('gentle', 'repo', 'owner', 'sys-admins', 'invalid');
    }

    public function testGrantGroupPrivilegesSuccess()
    {
        $endpoint       = 'group-privileges/gentle/repo/owner/sys-admins';
        $params         = 'read';

        $privileges = $this->getApiMock('Bitbucket\API\GroupPrivileges');

        /** @var $privileges \Bitbucket\API\GroupPrivileges */
        $privileges->grant('gentle', 'repo', 'owner', 'sys-admins', 'read');

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('PUT', $request->getMethod());
        $this->assertSame($params, $request->getBody()->getContents());
    }

    public function testRemoveGroupPrivilegesFromRepositorySuccess()
    {
        $endpoint       = 'group-privileges/gentle/repo/owner/sys-admins';

        $privileges = $this->getApiMock('Bitbucket\API\GroupPrivileges');

        /** @var $privileges \Bitbucket\API\GroupPrivileges */
        $privileges->delete('gentle', 'repo', 'owner', 'sys-admins');

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('DELETE', $request->getMethod());
    }
}
