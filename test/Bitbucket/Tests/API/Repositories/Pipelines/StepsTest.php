<?php

namespace Bitbucket\Tests\API\Repositories\Pipelines;

use Bitbucket\Tests\API as Tests;
use Bitbucket\API;

class StepsTest extends Tests\TestCase
{
    public function testGetAllSteps()
    {
        $endpoint       = 'repositories/gentle/eof/pipelines/pipeline-uuid/steps/';
        $expectedResult = $this->fakeResponse(array('dummy'));

        $client = $this->getHttpClientMock();
        $client->expects($this->once())
            ->method('get')
            ->with($endpoint)
            ->will($this->returnValue($expectedResult));

        /** @var \Bitbucket\API\Repositories\Pipelines\Steps $steps */
        $steps   = $this->getClassMock('Bitbucket\API\Repositories\Pipelines\Steps', $client);
        $actual     = $steps->all('gentle', 'eof', 'pipeline-uuid');

        $this->assertEquals($expectedResult, $actual);
    }

    public function testGetSpecificPipelineStep()
    {
        $endpoint       = 'repositories/gentle/eof/pipelines/pipeline-uuid/steps/step-uuid';
        $expectedResult = $this->fakeResponse(array('dummy'));

        $client = $this->getHttpClientMock();
        $client->expects($this->once())
            ->method('get')
            ->with($endpoint)
            ->will($this->returnValue($expectedResult));

        /** @var \Bitbucket\API\Repositories\Pipelines\Steps $steps */
        $steps   = $this->getClassMock('Bitbucket\API\Repositories\Pipelines\Steps', $client);
        $actual     = $steps->get('gentle', 'eof', 'pipeline-uuid', 'step-uuid');

        $this->assertEquals($expectedResult, $actual);
    }

    public function testGetLogOfSpecificPipelineStep()
    {
        $endpoint       = 'repositories/gentle/eof/pipelines/pipeline-uuid/steps/step-uuid/log';
        $expectedResult = $this->fakeResponse(array('dummy'));

        $client = $this->getHttpClientMock();
        $client->expects($this->once())
            ->method('get')
            ->with($endpoint)
            ->will($this->returnValue($expectedResult));

        /** @var \Bitbucket\API\Repositories\Pipelines\Steps $steps */
        $steps   = $this->getClassMock('Bitbucket\API\Repositories\Pipelines\Steps', $client);
        $actual     = $steps->log('gentle', 'eof', 'pipeline-uuid', 'step-uuid');

        $this->assertEquals($expectedResult, $actual);
    }
}
