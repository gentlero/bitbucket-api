<?php

namespace Bitbucket\Tests\API\Repositories;

use Bitbucket\Tests\API as Tests;
use Bitbucket\API;

class BranchRestrictionsTest extends Tests\TestCase
{
    public function testGetAllRestrictions()
    {
        $endpoint       = 'repositories/gentle/eof/branch-restrictions';
        $expectedResult = $this->fakeResponse(array('dummy'));

        $client = $this->getHttpClientMock();
        $client->expects($this->once())
            ->method('get')
            ->with($endpoint)
            ->will($this->returnValue($expectedResult));

        /** @var \Bitbucket\API\Repositories\BranchRestrictions $restrictions */
        $restrictions   = $this->getClassMock('Bitbucket\API\Repositories\BranchRestrictions', $client);
        $actual         = $restrictions->all('gentle', 'eof', array('dummy'));

        $this->assertEquals($expectedResult, $actual);
    }
}
