<?php

namespace Bitbucket\Tests\API\Repositories;

use Bitbucket\Tests\API as Tests;

class PipelinesTest extends Tests\TestCase
{
    public function testGetAllPipelines()
    {
        $endpoint = 'repositories/gentle/eof/pipelines/';
        $expectedResult = $this->addFakeResponse(array('dummy'));

        /** @var \Bitbucket\API\Repositories\Pipelines $pipelines */
        $pipelines = $this->getApiMock('Bitbucket\API\Repositories\Pipelines');
        $actual = $pipelines->all('gentle', 'eof');

        $this->assertEquals($expectedResult, $actual);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/2.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('GET', $request->getMethod());
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

        /** @var \Bitbucket\API\Repositories\Pipelines $pipelines */
        $pipelines = $this->getApiMock('Bitbucket\API\Repositories\Pipelines');

        $pipelines->create('gentle', 'eof', $params);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/2.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('POST', $request->getMethod());
        $this->assertSame(json_encode($params), $request->getBody()->getContents());
        $this->assertSame(['application/json'], $request->getHeader('Content-Type'));
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

        /** @var \Bitbucket\API\Repositories\Pipelines $pipelines */
        $pipelines = $this->getApiMock('Bitbucket\API\Repositories\Pipelines');

        $pipelines->create('gentle', 'eof', $params);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/2.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('POST', $request->getMethod());
        $this->assertSame($params, $request->getBody()->getContents());
    }

    public function testGetSpecificPipeline()
    {
        $endpoint = 'repositories/gentle/eof/pipelines/uuid';
        $expectedResult = $this->addFakeResponse(array('dummy'));

        /** @var \Bitbucket\API\Repositories\Pipelines $pipelines */
        $pipelines = $this->getApiMock('Bitbucket\API\Repositories\Pipelines');

        $actual = $pipelines->get('gentle', 'eof', 'uuid');

        $this->assertEquals($expectedResult, $actual);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/2.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('GET', $request->getMethod());
    }

    public function testStopSpecificPipeline()
    {
        $endpoint = 'repositories/gentle/eof/pipelines/uuid/stopPipeline';

        /** @var \Bitbucket\API\Repositories\Pipelines $pipelines */
        $pipelines = $this->getApiMock('Bitbucket\API\Repositories\Pipelines');

        $pipelines->stopPipeline('gentle', 'eof', 'uuid');

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/2.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('POST', $request->getMethod());
    }
}
