<?php

namespace Gentle\Bitbucket\Tests\API\Repo\Issues;

use Gentle\Bitbucket\Tests\API as Tests;
use Gentle\Bitbucket\API;

class VersionsTest extends Tests\TestCase
{
    public function testGetAllComponentsSuccess()
    {
        $endpoint       = 'repositories/gentle/eof/issues/versions';
        $expectedResult = json_encode('dummy');

        $versions = $this->getApiMock('Gentle\Bitbucket\API\Repo\Issues\Versions');
        $versions->expects($this->once())
            ->method('requestGet')
            ->with($endpoint)
            ->will( $this->returnValue($expectedResult) );

        /** @var $versions \Gentle\Bitbucket\API\Repo\Issues\Versions */
        $actual = $versions->all('gentle', 'eof');

        $this->assertEquals($expectedResult, $actual);
    }
}