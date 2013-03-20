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
        $actual = $components->all('gentle', 'eof', 3);

        $this->assertEquals($expectedResult, $actual);
    }
}