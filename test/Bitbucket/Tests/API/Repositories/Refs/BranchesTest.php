<?php

namespace Bitbucket\Tests\API\Repositories\Refs;

use Bitbucket\Tests\API as Tests;

class BranchesTest extends Tests\TestCase
{
    public function testAll()
    {
        $endpoint       = 'repositories/gentle/eof/refs/branches';
        $expectedResult = json_encode('dummy');

        $client = $this->getHttpClientMock();
        $client->expects($this->once())
            ->method('get')
            ->with($endpoint)
            ->will($this->returnValue($expectedResult));

        $repository = $this->getClassMock('Bitbucket\API\Repositories\Refs\Branches', $client);

        /** @var $repository \Bitbucket\API\Repositories\Refs\Branches */
        $actual = $repository->all('gentle', 'eof');

        $this->assertEquals($expectedResult, $actual);
    }

    public function testAllParams()
    {
        $params         = ['pagelen'=>36];
        $endpoint       = 'repositories/gentle/eof/refs/branches';
        $expectedResult = json_encode('dummy');

        $client = $this->getHttpClientMock();
        $client->expects($this->once())
            ->method('get')
            ->with($endpoint, $params)
            ->will($this->returnValue($expectedResult));

        $repository = $this->getClassMock('Bitbucket\API\Repositories\Refs\Branches', $client);

        /** @var $repository \Bitbucket\API\Repositories\Refs\Branches */
        $actual = $repository->all('gentle', 'eof', $params);

        $this->assertEquals($expectedResult, $actual);
    }

    public function testGet()
    {
        $endpoint       = 'repositories/gentle/eof/refs/branches/abranch';
        $expectedResult = json_encode('dummy');

        $client = $this->getHttpClientMock();
        $client->expects($this->once())
            ->method('get')
            ->with($endpoint)
            ->will($this->returnValue($expectedResult));

        $repository = $this->getClassMock('Bitbucket\API\Repositories\Refs\Branches', $client);

        /** @var $repository \Bitbucket\API\Repositories\Refs\Branches */
        $actual = $repository->get('gentle', 'eof', 'abranch');

        $this->assertEquals($expectedResult, $actual);
    }
}
