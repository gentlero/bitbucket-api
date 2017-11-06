<?php

namespace Bitbucket\Tests\API\Repositories;

use Bitbucket\Tests\API as Tests;

class PipelinesTest extends Tests\TestCase
{
    public function testGetAllPipelines()
    {
        $endpoint = 'repositories/gentle/eof/pipelines/';
        $expectedResult = $this->fakeResponse(array('dummy'));

        $client = $this->getHttpClientMock();
        $client->expects($this->any())
            ->method('get')
            ->with($endpoint)
            ->will($this->returnValue($expectedResult));

        /** @var \Bitbucket\API\Repositories\Pipelines $pipelines */
        $pipelines = $this->getClassMock('Bitbucket\API\Repositories\Pipelines', $client);
        $actual = $pipelines->all('gentle', 'eof');

        $this->assertEquals($expectedResult, $actual);
    }

    public function testCreatePipelinesFromArray()
    {
        $endpoint = 'repositories/gentle/eof/pipelines/';
        $params = array(
            'type' => array(
                'ref_type' => 'branch',
                'type' => 'pipeline_ref_target',
                'ref_name' => 'master'
            )
        );

        $client = $this->getHttpClientMock();
        $client->expects($this->once())
            ->method('post')
            ->with($endpoint, json_encode($params));

        /** @var \Bitbucket\API\Repositories\Pipelines $pipelines */
        $pipelines = $this->getClassMock('Bitbucket\API\Repositories\Pipelines', $client);

        $pipelines->create('gentle', 'eof', $params);
    }

    public function testCreatePipelinesFromJson()
    {
        $endpoint = 'repositories/gentle/eof/pipelines/';
        $params = json_encode(array(
            'type' => array(
                'ref_type' => 'branch',
                'type' => 'pipeline_ref_target',
                'ref_name' => 'master'
            )
        ));

        $client = $this->getHttpClientMock();
        $client->expects($this->once())
            ->method('post')
            ->with($endpoint, $params);

        /** @var \Bitbucket\API\Repositories\Pipelines $pipelines */
        $pipelines = $this->getClassMock('Bitbucket\API\Repositories\Pipelines', $client);

        $pipelines->create('gentle', 'eof', $params);
    }

    public function testGetSpecificPipeline()
    {
        $endpoint = 'repositories/gentle/eof/pipelines/uuid';
        $expectedResult = $this->fakeResponse(array('dummy'));

        $client = $this->getHttpClientMock();
        $client->expects($this->once())
            ->method('get')
            ->with($endpoint)
            ->will($this->returnValue($expectedResult));

        /** @var \Bitbucket\API\Repositories\Pipelines $pipelines */
        $pipelines = $this->getClassMock('Bitbucket\API\Repositories\Pipelines', $client);

        $actual = $pipelines->get('gentle', 'eof', 'uuid');

        $this->assertEquals($expectedResult, $actual);
    }

    public function testStopSpecificPipeline()
    {
        $endpoint = 'repositories/gentle/eof/pipelines/uuid/stopPipeline';

        $client = $this->getHttpClientMock();
        $client->expects($this->once())
            ->method('post')
            ->with($endpoint);

        /** @var \Bitbucket\API\Repositories\Pipelines $pipelines */
        $pipelines = $this->getClassMock('Bitbucket\API\Repositories\Pipelines', $client);

        $pipelines->stopPipeline('gentle', 'eof', 'uuid');
    }
}
