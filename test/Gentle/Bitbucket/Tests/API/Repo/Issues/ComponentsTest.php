<?php

namespace Gentle\Bitbucket\Tests\API\Repo\Issues;

use Gentle\Bitbucket\Tests\API as Tests;
use Gentle\Bitbucket\API;

class ComponentsTest extends Tests\TestCase
{
    public function testGetAllComponentsSuccess()
    {
        $endpoint       = 'repositories/gentle/eof/issues/components';
        $expectedResult = json_encode('dummy');

        $components = $this->getApiMock('Gentle\Bitbucket\API\Repo\Issues\Components');
        $components->expects($this->once())
            ->method('requestGet')
            ->with($endpoint)
            ->will( $this->returnValue($expectedResult) );

        /** @var $components\Gentle\Bitbucket\API\Repo\Issues\Components */
        $actual = $components->all('gentle', 'eof');

        $this->assertEquals($expectedResult, $actual);
    }

    public function testGetSingleComponentSuccess()
    {
        $endpoint       = 'repositories/gentle/eof/issues/components/2';
        $expectedResult = json_encode('dummy');

        $components = $this->getApiMock('Gentle\Bitbucket\API\Repo\Issues\Components');
        $components->expects($this->once())
            ->method('requestGet')
            ->with($endpoint)
            ->will( $this->returnValue($expectedResult) );

        /** @var $components \Gentle\Bitbucket\API\Repo\Issues\Components */
        $actual = $components->get('gentle', 'eof', 2);

        $this->assertEquals($expectedResult, $actual);
    }

    public function testCreateComponentSuccess()
    {
        $endpoint       = 'repositories/gentle/eof/issues/components';
        $params         = array('name' => 'dummy');

        $component = $this->getApiMock('Gentle\Bitbucket\API\Repo\Issues\Components');
        $component->expects($this->once())
            ->method('requestPost')
            ->with($endpoint, $params);

        /** @var $component \Gentle\Bitbucket\API\Repo\Issues\Components */
        $component->create('gentle', 'eof', 'dummy');
    }
}