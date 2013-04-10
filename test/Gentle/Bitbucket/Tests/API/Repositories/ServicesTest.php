<?php

namespace Gentle\Bitbucket\Tests\API\Repositories;

use Gentle\Bitbucket\Tests\API as Tests;
use Gentle\Bitbucket\API;

class ServicesTest extends Tests\TestCase
{
    public function testGetAllServices()
    {
        $endpoint       = 'repositories/gentle/eof/services';
        $expectedResult = json_encode('dummy');

        $services = $this->getApiMock('Gentle\Bitbucket\API\Repositories\Services');
        $services->expects($this->once())
            ->method('requestGet')
            ->with($endpoint)
            ->will( $this->returnValue($expectedResult) );

        /** @var $services \Gentle\Bitbucket\API\Repositories\Services */
        $actual = $services->all('gentle', 'eof');

        $this->assertEquals($expectedResult, $actual);
    }
}