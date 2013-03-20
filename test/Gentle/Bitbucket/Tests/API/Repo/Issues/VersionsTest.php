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

    public function testGetSingleVersionSuccess()
    {
        $endpoint       = 'repositories/gentle/eof/issues/versions/2';
        $expectedResult = json_encode('dummy');

        $version = $this->getApiMock('Gentle\Bitbucket\API\Repo\Issues\Versions');
        $version->expects($this->once())
            ->method('requestGet')
            ->with($endpoint)
            ->will( $this->returnValue($expectedResult) );

        /** @var $version \Gentle\Bitbucket\API\Repo\Issues\Versions */
        $actual = $version->get('gentle', 'eof', 2);

        $this->assertEquals($expectedResult, $actual);
    }

    public function testCreateVersionSuccess()
    {
        $endpoint       = 'repositories/gentle/eof/issues/versions';
        $params         = array('name' => 'dummy');

        $version = $this->getApiMock('Gentle\Bitbucket\API\Repo\Issues\Versions');
        $version->expects($this->once())
            ->method('requestPost')
            ->with($endpoint, $params);

        /** @var $version \Gentle\Bitbucket\API\Repo\Issues\Versions */
        $version->create('gentle', 'eof', 'dummy');
    }
}