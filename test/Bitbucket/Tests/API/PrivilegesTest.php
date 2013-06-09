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
        $privileges->expects($this->once())
            ->method('requestGet')
            ->with($endpoint);

        /** @var $privileges \Bitbucket\API\Privileges */
        $privileges->repository('gentle', 'test3');
    }

    public function testGetRepositoryPrivilegesWithFilterSuccess()
    {
        $endpoint       = 'privileges/gentle/test3';
        $params         = array('filter' => 'read');

        $privileges = $this->getApiMock('Bitbucket\API\Privileges');
        $privileges->expects($this->once())
            ->method('requestGet')
            ->with($endpoint, $params);

        /** @var $privileges \Bitbucket\API\Privileges */
        $privileges->repository('gentle', 'test3', 'read');
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
        $privileges->expects($this->once())
            ->method('requestGet')
            ->with($endpoint);

        /** @var $privileges \Bitbucket\API\Privileges */
        $privileges->account('gentle', 'test3', 'vimishor');
    }

    public function testGetRepositoriesPrivilegesWithoutFilterSuccess()
    {
        $endpoint       = 'privileges/gentle';

        $privileges = $this->getApiMock('Bitbucket\API\Privileges');
        $privileges->expects($this->once())
            ->method('requestGet')
            ->with($endpoint);

        /** @var $privileges \Bitbucket\API\Privileges */
        $privileges->repositories('gentle');
    }

    public function testGetRepositoriesPrivilegesWithFilterSuccess()
    {
        $endpoint       = 'privileges/gentle';
        $params         = array('filter' => 'write');

        $privileges = $this->getApiMock('Bitbucket\API\Privileges');
        $privileges->expects($this->once())
            ->method('requestGet')
            ->with($endpoint, $params);

        /** @var $privileges \Bitbucket\API\Privileges */
        $privileges->repositories('gentle', 'write');
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
        $params         = array(
            'filter' => 'read'
        );

        $privileges = $this->getApiMock('Bitbucket\API\Privileges');
        $privileges->expects($this->once())
            ->method('requestPut')
            ->with($endpoint, $params);

        /** @var $privileges \Bitbucket\API\Privileges */
        $privileges->grant('gentle', 'repo', 'vimishor', 'read');
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
        $privileges->expects($this->once())
            ->method('requestDelete')
            ->with($endpoint);

        /** @var $privileges \Bitbucket\API\Privileges */
        $privileges->delete('gentle', 'repo', 'vimishor');
    }

    public function testDeleteAllPrivilegesFromRepositorySuccess()
    {
        $endpoint       = 'privileges/gentle/repo';

        $privileges = $this->getApiMock('Bitbucket\API\Privileges');
        $privileges->expects($this->once())
            ->method('requestDelete')
            ->with($endpoint);

        /** @var $privileges \Bitbucket\API\Privileges */
        $privileges->delete('gentle', 'repo');
    }

    public function testDeleteAllPrivilegesFromAllRepositoriesSuccess()
    {
        $endpoint       = 'privileges/gentle';

        $privileges = $this->getApiMock('Bitbucket\API\Privileges');
        $privileges->expects($this->once())
            ->method('requestDelete')
            ->with($endpoint);

        /** @var $privileges \Bitbucket\API\Privileges */
        $privileges->delete('gentle');
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