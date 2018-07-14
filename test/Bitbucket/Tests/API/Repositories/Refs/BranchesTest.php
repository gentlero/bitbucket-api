<?php

namespace Bitbucket\Tests\API\Repositories\Refs;

use Bitbucket\Tests\API as Tests;

class BranchesTest extends Tests\TestCase
{
    public function testAll()
    {
        $endpoint       = 'repositories/gentle/eof/refs/branches';
        $expectedResult = $this->addFakeResponse(json_encode('dummy'));

        /** @var $repository \Bitbucket\API\Repositories\Refs\Branches */
        $repository = $this->getApiMock('Bitbucket\API\Repositories\Refs\Branches');

        $actual = $repository->all('gentle', 'eof');

        $this->assertEquals($expectedResult, $actual);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/2.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('GET', $request->getMethod());
    }

    public function testAllParams()
    {
        $params         = ['pagelen'=>36];
        $endpoint       = 'repositories/gentle/eof/refs/branches';
        $expectedResult = $this->addFakeResponse(json_encode('dummy'));

        /** @var $repository \Bitbucket\API\Repositories\Refs\Branches */
        $repository = $this->getApiMock('Bitbucket\API\Repositories\Refs\Branches');

        $actual = $repository->all('gentle', 'eof', $params);

        $this->assertEquals($expectedResult, $actual);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/2.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('GET', $request->getMethod());
        $this->assertSame('pagelen=36', $request->getUri()->getQuery());
    }

    public function testGet()
    {
        $endpoint       = 'repositories/gentle/eof/refs/branches/abranch';
        $expectedResult = $this->addFakeResponse(json_encode('dummy'));

        /** @var $repository \Bitbucket\API\Repositories\Refs\Branches */
        $repository = $this->getApiMock('Bitbucket\API\Repositories\Refs\Branches');

        $actual = $repository->get('gentle', 'eof', 'abranch');

        $this->assertEquals($expectedResult, $actual);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/2.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('GET', $request->getMethod());
    }
}
