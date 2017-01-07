<?php

namespace Bitbucket\Tests\API\Repositories\Refs;

use Bitbucket\Tests\API as Tests;

class TagsTest extends Tests\TestCase
{
    public function testAll()
    {
        $endpoint       = 'repositories/gentle/eof/refs/tags';
        $expectedResult = json_encode('dummy');

        $client = $this->getHttpClientMock();
        $client->expects($this->once())
            ->method('get')
            ->with($endpoint)
            ->will($this->returnValue($expectedResult));

        $repository = $this->getClassMock('Bitbucket\API\Repositories\Refs\Tags', $client);

        /** @var $repository \Bitbucket\API\Repositories\Refs\Tags */
        $actual = $repository->all('gentle', 'eof');

        $this->assertEquals($expectedResult, $actual);
    }

    public function testAllParams()
    {
        $params         = ['pagelen'=>36];
        $endpoint       = 'repositories/gentle/eof/refs/tags';
        $expectedResult = json_encode('dummy');

        $client = $this->getHttpClientMock();
        $client->expects($this->once())
            ->method('get')
            ->with($endpoint, $params)
            ->will($this->returnValue($expectedResult));

        $repository = $this->getClassMock('Bitbucket\API\Repositories\Refs\Tags', $client);

        /** @var $repository \Bitbucket\API\Repositories\Refs\Tags */
        $actual = $repository->all('gentle', 'eof', $params);

        $this->assertEquals($expectedResult, $actual);
    }

    public function testGet()
    {
        $endpoint       = 'repositories/gentle/eof/refs/tags/atag';
        $expectedResult = json_encode('dummy');

        $client = $this->getHttpClientMock();
        $client->expects($this->once())
            ->method('get')
            ->with($endpoint)
            ->will($this->returnValue($expectedResult));

        $repository = $this->getClassMock('Bitbucket\API\Repositories\Refs\Tags', $client);

        /** @var $repository \Bitbucket\API\Repositories\Refs\Tags */
        $actual = $repository->get('gentle', 'eof', 'atag');

        $this->assertEquals($expectedResult, $actual);
    }

    public function testCreate()
    {
        $endpoint       = 'repositories/gentle/eof/refs/tags';
        $expectedResult = json_encode('dummy');

        $client = $this->getHttpClientMock();
        $client->expects($this->once())
            ->method('post')
            ->with($endpoint)
            ->will($this->returnValue($expectedResult));

        $repository = $this->getClassMock('Bitbucket\API\Repositories\Refs\Tags', $client);

        /** @var $repository \Bitbucket\API\Repositories\Refs\Tags */
        $actual = $repository->create('gentle', 'eof', 'atag', '2310abb944423ecf1a90be9888dafd096744b531');

        $this->assertEquals($expectedResult, $actual);
    }
}
