<?php

namespace Gentle\Bitbucket\Tests\API\Repositories;

use Gentle\Bitbucket\Tests\API as Tests;
use Gentle\Bitbucket\API;

class WikiTest extends Tests\TestCase
{
    public function testGetWikiPage()
    {
        $endpoint       = 'repositories/gentle/eof/wiki/Home';
        $expectedResult = json_encode('dummy');

        $wiki = $this->getApiMock('Gentle\Bitbucket\API\Repositories\Wiki');
        $wiki->expects($this->once())
            ->method('requestGet')
            ->with($endpoint)
            ->will( $this->returnValue($expectedResult) );

        /** @var $wiki \Gentle\Bitbucket\API\Repositories\Wiki */
        $actual = $wiki->get('gentle', 'eof', 'Home');

        $this->assertEquals($expectedResult, $actual);
    }
}