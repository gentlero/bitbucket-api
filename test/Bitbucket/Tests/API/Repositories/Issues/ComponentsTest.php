<?php

namespace Bitbucket\Tests\API\Repositories\Issues;

use Bitbucket\Tests\API as Tests;
use Bitbucket\API;

class ComponentsTest extends Tests\TestCase
{
    public function testGetAllComponentsSuccess()
    {
        $endpoint       = 'repositories/gentle/eof/issues/components';
        $expectedResult = json_encode('dummy');

        $components = $this->getApiMock('Bitbucket\API\Repositories\Issues\Components');
        $components->expects($this->once())
            ->method('requestGet')
            ->with($endpoint)
            ->will( $this->returnValue($expectedResult) );

        /** @var $components \Bitbucket\API\Repositories\Issues\Components */
        $actual = $components->all('gentle', 'eof');

        $this->assertEquals($expectedResult, $actual);
    }

    public function testGetSingleComponentSuccess()
    {
        $endpoint       = 'repositories/gentle/eof/issues/components/2';
        $expectedResult = json_encode('dummy');

        $components = $this->getApiMock('Bitbucket\API\Repositories\Issues\Components');
        $components->expects($this->once())
            ->method('requestGet')
            ->with($endpoint)
            ->will( $this->returnValue($expectedResult) );

        /** @var $components \Bitbucket\API\Repositories\Issues\Components */
        $actual = $components->get('gentle', 'eof', 2);

        $this->assertEquals($expectedResult, $actual);
    }

    public function testCreateComponentSuccess()
    {
        $endpoint       = 'repositories/gentle/eof/issues/components';
        $params         = array('name' => 'dummy');

        $component = $this->getApiMock('Bitbucket\API\Repositories\Issues\Components');
        $component->expects($this->once())
            ->method('requestPost')
            ->with($endpoint, $params);

        /** @var $component \Bitbucket\API\Repositories\Issues\Components */
        $component->create('gentle', 'eof', 'dummy');
    }

    public function testUpdateComponentSuccess()
    {
        $endpoint       = 'repositories/gentle/eof/issues/components/3';
        $params         = array('name' => 'dummy');

        $component = $this->getApiMock('Bitbucket\API\Repositories\Issues\Components');
        $component->expects($this->once())
            ->method('requestPut')
            ->with($endpoint, $params);

        /** @var $component \Bitbucket\API\Repositories\Issues\Components */
        $component->update('gentle', 'eof', 3, 'dummy');
    }

    public function testDeleteComponentSuccess()
    {
        $endpoint       = 'repositories/gentle/eof/issues/components/3';

        $component = $this->getApiMock('Bitbucket\API\Repositories\Issues\Components');
        $component->expects($this->once())
            ->method('requestDelete')
            ->with($endpoint);

        /** @var $component \Bitbucket\API\Repositories\Issues\Components */
        $component->delete('gentle', 'eof', 3);
    }
}