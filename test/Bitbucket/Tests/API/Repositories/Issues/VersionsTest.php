<?php

namespace Bitbucket\Tests\API\Repositories\Issues;

use Bitbucket\Tests\API as Tests;
use Bitbucket\API;

class VersionsTest extends Tests\TestCase
{
    public function testGetAllComponentsSuccess()
    {
        $endpoint       = 'repositories/gentle/eof/issues/versions';
        $expectedResult = json_encode('dummy');

        $versions = $this->getApiMock('Bitbucket\API\Repositories\Issues\Versions');
        $versions->expects($this->once())
            ->method('requestGet')
            ->with($endpoint)
            ->will( $this->returnValue($expectedResult) );

        /** @var $versions \Bitbucket\API\Repositories\Issues\Versions */
        $actual = $versions->all('gentle', 'eof');

        $this->assertEquals($expectedResult, $actual);
    }

    public function testGetSingleVersionSuccess()
    {
        $endpoint       = 'repositories/gentle/eof/issues/versions/2';
        $expectedResult = json_encode('dummy');

        $version = $this->getApiMock('Bitbucket\API\Repositories\Issues\Versions');
        $version->expects($this->once())
            ->method('requestGet')
            ->with($endpoint)
            ->will( $this->returnValue($expectedResult) );

        /** @var $version \Bitbucket\API\Repositories\Issues\Versions */
        $actual = $version->get('gentle', 'eof', 2);

        $this->assertEquals($expectedResult, $actual);
    }

    public function testCreateVersionSuccess()
    {
        $endpoint       = 'repositories/gentle/eof/issues/versions';
        $params         = array('name' => 'dummy');

        $version = $this->getApiMock('Bitbucket\API\Repositories\Issues\Versions');
        $version->expects($this->once())
            ->method('requestPost')
            ->with($endpoint, $params);

        /** @var $version \Bitbucket\API\Repositories\Issues\Versions */
        $version->create('gentle', 'eof', 'dummy');
    }

    public function testUpdateVersionSuccess()
    {
        $endpoint       = 'repositories/gentle/eof/issues/versions/3';
        $params         = array('name' => 'dummy');

        $version = $this->getApiMock('Bitbucket\API\Repositories\Issues\Versions');
        $version->expects($this->once())
            ->method('requestPut')
            ->with($endpoint, $params);

        /** @var $version \Bitbucket\API\Repositories\Issues\Versions */
        $version->update('gentle', 'eof', 3, 'dummy');
    }

    public function testDeleteVersionSuccess()
    {
        $endpoint       = 'repositories/gentle/eof/issues/versions/3';

        $version = $this->getApiMock('Bitbucket\API\Repositories\Issues\Versions');
        $version->expects($this->once())
            ->method('requestDelete')
            ->with($endpoint);

        /** @var $version \Bitbucket\API\Repositories\Issues\Versions */
        $version->delete('gentle', 'eof', 3);
    }
}