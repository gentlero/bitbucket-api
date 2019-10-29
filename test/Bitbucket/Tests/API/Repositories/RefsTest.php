<?php

namespace Bitbucket\Tests\API\Repositories;

use Bitbucket\Tests\API as Tests;

class RefsTest extends Tests\TestCase
{
    public function testAll()
    {
        $endpoint       = 'repositories/gentle/eof/refs';
        $expectedResult = json_encode('dummy');

        $client = $this->getHttpClientMock();
        $client->expects($this->once())
            ->method('get')
            ->with($endpoint)
            ->will($this->returnValue($expectedResult));

        $refs = $this->getClassMock('Bitbucket\API\Repositories\Refs', $client);

        /** @var $refs \Bitbucket\API\Repositories\Refs */
        $actual = $refs->all('gentle', 'eof');

        $this->assertEquals($expectedResult, $actual);
    }

    public function testAllParams()
    {
        $params         = ['pagelen' => 36];
        $endpoint       = 'repositories/gentle/eof/refs';
        $expectedResult = json_encode('dummy');

        $client = $this->getHttpClientMock();
        $client->expects($this->once())
            ->method('get')
            ->with($endpoint, $params)
            ->will($this->returnValue($expectedResult));

        $refs = $this->getClassMock('Bitbucket\API\Repositories\Refs', $client);

        /** @var $refs \Bitbucket\API\Repositories\Refs */
        $actual = $refs->all('gentle', 'eof', $params);

        $this->assertEquals($expectedResult, $actual);
    }
}
