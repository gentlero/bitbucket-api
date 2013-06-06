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

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testGetRepositoriesPrivilegesInvalidPrivilege()
    {
        $privileges = $this->getApiMock('Bitbucket\API\Privileges');

        /** @var $privileges \Bitbucket\API\Privileges */
        $privileges->repositories('gentle', 'invalid');
    }
}