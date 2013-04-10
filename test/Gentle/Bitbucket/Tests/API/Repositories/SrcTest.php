<?php

namespace Gentle\Bitbucket\Tests\API\Repositories;

use Gentle\Bitbucket\Tests\API as Tests;
use Gentle\Bitbucket\API;

class SrcTest extends Tests\TestCase
{
    public function testListRepoSrc()
    {
        $endpoint       = 'repositories/gentle/eof/src/1e10ffe//lib';
        $expectedResult = json_encode('dummy');

        $src = $this->getApiMock('Gentle\Bitbucket\API\Repositories\Src');
        $src->expects($this->once())
            ->method('requestGet')
            ->with($endpoint)
            ->will( $this->returnValue($expectedResult) );

        /** @var $src \Gentle\Bitbucket\API\Repositories\Src */
        $actual = $src->get('gentle', 'eof', '1e10ffe', '/lib');

        $this->assertEquals($expectedResult, $actual);
    }
}