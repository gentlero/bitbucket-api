<?php

namespace Bitbucket\Tests\API;

use Bitbucket\Tests\API as Tests;
use Bitbucket\API;

class PrivilegesTest extends Tests\TestCase
{
    public function testGetPrivilegesWithoutFilterSuccess()
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
    public function testGetPrivilegesInvalidPrivilege()
    {
        $privileges = $this->getApiMock('Bitbucket\API\Privileges');

        /** @var $privileges \Bitbucket\API\Privileges */
        $privileges->repository('gentle', 'repo', 'invalid');
    }
}