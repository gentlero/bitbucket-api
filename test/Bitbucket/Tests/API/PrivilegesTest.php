<?php

namespace Bitbucket\Tests\API;

use Bitbucket\Tests\API as Tests;
use Bitbucket\API;

class PrivilegesTest extends Tests\TestCase
{
    public function testGetRepositoryPrivilegesWithoutFilterSuccess()
    {
        $endpoint       = 'privileges/gentle/test3';

        $privileges = $this->getApiMock('Bitbucket\API\Privileges');

        /** @var $privileges \Bitbucket\API\Privileges */
        $privileges->repository('gentle', 'test3');

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('GET', $request->getMethod());
    }

    public function testGetRepositoryPrivilegesWithFilterSuccess()
    {
        $endpoint       = 'privileges/gentle/test3';

        $privileges = $this->getApiMock('Bitbucket\API\Privileges');

        /** @var $privileges \Bitbucket\API\Privileges */
        $privileges->repository('gentle', 'test3', 'read');

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('GET', $request->getMethod());
        $this->assertSame('filter=read&format=json', $request->getUri()->getQuery());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testGetRepositoryPrivilegesInvalidPrivilege()
    {
        $privileges = $this->getApiMock('Bitbucket\API\Privileges');

        /** @var $privileges \Bitbucket\API\Privileges */
        $privileges->repository('gentle', 'repo', 'invalid');
    }

    public function testGetAccountPrivilegesSuccess()
    {
        $endpoint       = 'privileges/gentle/test3/vimishor';

        $privileges = $this->getApiMock('Bitbucket\API\Privileges');

        /** @var $privileges \Bitbucket\API\Privileges */
        $privileges->account('gentle', 'test3', 'vimishor');

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('GET', $request->getMethod());
    }

    public function testGetRepositoriesPrivilegesWithoutFilterSuccess()
    {
        $endpoint       = 'privileges/gentle';

        $privileges = $this->getApiMock('Bitbucket\API\Privileges');

        /** @var $privileges \Bitbucket\API\Privileges */
        $privileges->repositories('gentle');

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('GET', $request->getMethod());
    }

    public function testGetRepositoriesPrivilegesWithFilterSuccess()
    {
        $endpoint       = 'privileges/gentle';

        $privileges = $this->getApiMock('Bitbucket\API\Privileges');

        /** @var $privileges \Bitbucket\API\Privileges */
        $privileges->repositories('gentle', 'write');

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('GET', $request->getMethod());
        $this->assertSame('filter=write&format=json', $request->getUri()->getQuery());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testGetRepositoriesPrivilegesInvalidPrivilege()
    {
        $privileges = $this->getApiMock('Bitbucket\API\Privileges');

        /** @var $privileges \Bitbucket\API\Privileges */
        $privileges->repositories('gentle', 'invalid');
    }

    public function testGrantPrivilegesSuccess()
    {
        $endpoint       = 'privileges/gentle/repo/vimishor';

        $privileges = $this->getApiMock('Bitbucket\API\Privileges');

        /** @var $privileges \Bitbucket\API\Privileges */
        $privileges->grant('gentle', 'repo', 'vimishor', 'read');

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('PUT', $request->getMethod());
        $this->assertSame('read', $request->getBody()->getContents());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testGrantPrivilegesInvalidPrivilege()
    {
        $privileges = $this->getApiMock('Bitbucket\API\Privileges');

        /** @var $privileges \Bitbucket\API\Privileges */
        $privileges->grant('gentle', 'repo', 'vimishor', 'invalid');
    }

    public function testDeleteAccountPrivilegesFromRepositorySuccess()
    {
        $endpoint       = 'privileges/gentle/repo/vimishor';

        $privileges = $this->getApiMock('Bitbucket\API\Privileges');

        /** @var $privileges \Bitbucket\API\Privileges */
        $privileges->delete('gentle', 'repo', 'vimishor');

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('DELETE', $request->getMethod());
    }

    public function testDeleteAllPrivilegesFromRepositorySuccess()
    {
        $endpoint       = 'privileges/gentle/repo';

        $privileges = $this->getApiMock('Bitbucket\API\Privileges');

        /** @var $privileges \Bitbucket\API\Privileges */
        $privileges->delete('gentle', 'repo');

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('DELETE', $request->getMethod());
    }

    public function testDeleteAllPrivilegesFromAllRepositoriesSuccess()
    {
        $endpoint       = 'privileges/gentle';

        $privileges = $this->getApiMock('Bitbucket\API\Privileges');

        /** @var $privileges \Bitbucket\API\Privileges */
        $privileges->delete('gentle');

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('DELETE', $request->getMethod());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testDeleteAccountPrivilegesInvalidParams()
    {
        $privileges = $this->getApiMock('Bitbucket\API\Privileges');

        /** @var $privileges \Bitbucket\API\Privileges */
        $privileges->delete('gentle', null, 'vimishor');
    }
}
