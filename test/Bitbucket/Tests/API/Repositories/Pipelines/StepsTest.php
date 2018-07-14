<?php

namespace Bitbucket\Tests\API\Repositories\Pipelines;

use Bitbucket\Tests\API as Tests;
use Bitbucket\API;

class StepsTest extends Tests\TestCase
{
    public function testGetAllSteps()
    {
        $endpoint = 'repositories/gentle/eof/pipelines/pipeline-uuid/steps/';
        $expectedResult = $this->addFakeResponse(array('dummy'));

        /** @var \Bitbucket\API\Repositories\Pipelines\Steps $steps */
        $steps = $this->getApiMock('Bitbucket\API\Repositories\Pipelines\Steps');
        $actual = $steps->all('gentle', 'eof', 'pipeline-uuid');

        $this->assertEquals($expectedResult, $actual);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/2.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('GET', $request->getMethod());
    }

    public function testGetSpecificPipelineStep()
    {
        $endpoint = 'repositories/gentle/eof/pipelines/pipeline-uuid/steps/step-uuid';
        $expectedResult = $this->addFakeResponse(array('dummy'));

        /** @var \Bitbucket\API\Repositories\Pipelines\Steps $steps */
        $steps = $this->getApiMock('Bitbucket\API\Repositories\Pipelines\Steps');
        $actual = $steps->get('gentle', 'eof', 'pipeline-uuid', 'step-uuid');

        $this->assertEquals($expectedResult, $actual);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/2.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('GET', $request->getMethod());
    }

    public function testGetLogOfSpecificPipelineStep()
    {
        $endpoint = 'repositories/gentle/eof/pipelines/pipeline-uuid/steps/step-uuid/log';
        $expectedResult = $this->addFakeResponse(array('dummy'));

        /** @var \Bitbucket\API\Repositories\Pipelines\Steps $steps */
        $steps = $this->getApiMock('Bitbucket\API\Repositories\Pipelines\Steps');
        $actual = $steps->log('gentle', 'eof', 'pipeline-uuid', 'step-uuid');

        $this->assertEquals($expectedResult, $actual);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/2.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('GET', $request->getMethod());
    }
}
