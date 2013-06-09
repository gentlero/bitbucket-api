<?php

namespace Bitbucket\Tests\API\Repositories;

use Bitbucket\Tests\API as Tests;
use Bitbucket\API;

class ServicesTest extends Tests\TestCase
{
    public function testGetAllServices()
    {
        $endpoint       = 'repositories/gentle/eof/services';
        $expectedResult = json_encode('dummy');

        $services = $this->getApiMock('Bitbucket\API\Repositories\Services');
        $services->expects($this->once())
            ->method('requestGet')
            ->with($endpoint)
            ->will( $this->returnValue($expectedResult) );

        /** @var $services \Bitbucket\API\Repositories\Services */
        $actual = $services->all('gentle', 'eof');

        $this->assertEquals($expectedResult, $actual);
    }

    public function testGetSingleservice()
    {
        $endpoint       = 'repositories/gentle/eof/services/3';
        $expectedResult = json_encode('dummy');

        $service = $this->getApiMock('Bitbucket\API\Repositories\Services');
        $service->expects($this->once())
            ->method('requestGet')
            ->with($endpoint)
            ->will( $this->returnValue($expectedResult) );

        /** @var $service \Bitbucket\API\Repositories\Services */
        $actual = $service->get('gentle', 'eof', 3);

        $this->assertEquals($expectedResult, $actual);
    }

    public function testCreateServiceSuccess()
    {
        $endpoint       = 'repositories/gentle/eof/services';
        $params         = array(
            'type'  => 'POST',
            'URL'   => 'https://example.com/post'
        );

        $service = $this->getApiMock('Bitbucket\API\Repositories\Services');
        $service->expects($this->once())
            ->method('requestPost')
            ->with($endpoint, $params);

        /** @var $service \Bitbucket\API\Repositories\Services */
        $service->create('gentle', 'eof', 'POST', array('URL' => 'https://example.com/post') );
    }

    public function testUpdateServiceSuccess()
    {
        $endpoint       = 'repositories/gentle/eof/services/3';
        $params         = array(
            'URL' => 'https://example.com'
        );

        $service = $this->getApiMock('Bitbucket\API\Repositories\Services');
        $service->expects($this->once())
            ->method('requestPut')
            ->with($endpoint, $params);

        /** @var $service \Bitbucket\API\Repositories\Services */
        $service->update('gentle', 'eof', 3, array('URL' => 'https://example.com'));
    }

    public function testDeleteServiceSuccess()
    {
        $endpoint       = 'repositories/gentle/eof/services/3';

        $service = $this->getApiMock('Bitbucket\API\Repositories\Services');
        $service->expects($this->once())
            ->method('requestDelete')
            ->with($endpoint);

        /** @var $service \Bitbucket\API\Repositories\Issues\Services */
        $service->delete('gentle', 'eof', 3);
    }
}