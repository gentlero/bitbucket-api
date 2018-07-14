<?php

namespace Bitbucket\Tests\API\Repositories\Issues;

use Bitbucket\Tests\API as Tests;
use Bitbucket\API;

class MilestonesTest extends Tests\TestCase
{
    public function testGetAllMilestonesSuccess()
    {
        $endpoint       = 'repositories/gentle/eof/issues/milestones';
        $expectedResult = $this->addFakeResponse(json_encode('dummy'));

        /** @var $milestones \Bitbucket\API\Repositories\Issues\Milestones */
        $milestones = $this->getApiMock('Bitbucket\API\Repositories\Issues\Milestones');

        $actual = $milestones->all('gentle', 'eof');

        $this->assertEquals($expectedResult, $actual);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('GET', $request->getMethod());
    }

    public function testGetSingleMilestoneSuccess()
    {
        $endpoint       = 'repositories/gentle/eof/issues/milestones/2';
        $expectedResult = $this->addFakeResponse(json_encode('dummy'));

        /** @var $milestone \Bitbucket\API\Repositories\Issues\Milestones */
        $milestone = $this->getApiMock('Bitbucket\API\Repositories\Issues\Milestones');

        $actual = $milestone->get('gentle', 'eof', 2);

        $this->assertEquals($expectedResult, $actual);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('GET', $request->getMethod());
    }

    public function testCreateMilestoneSuccess()
    {
        $endpoint       = 'repositories/gentle/eof/issues/milestones';

        /** @var $milestone \Bitbucket\API\Repositories\Issues\Milestones */
        $milestone = $this->getApiMock('Bitbucket\API\Repositories\Issues\Milestones');

        $milestone->create('gentle', 'eof', 'dummy');

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('POST', $request->getMethod());
        $this->assertSame('name=dummy', $request->getBody()->getContents());
    }

    public function testUpdateMilestoneSuccess()
    {
        $endpoint       = 'repositories/gentle/eof/issues/milestones/3';

        /** @var $milestone \Bitbucket\API\Repositories\Issues\Milestones */
        $milestone = $this->getApiMock('Bitbucket\API\Repositories\Issues\Milestones');

        $milestone->update('gentle', 'eof', 3, 'dummy');

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('PUT', $request->getMethod());
        $this->assertSame('name=dummy', $request->getBody()->getContents());
    }

    public function testDeleteMilestoneSuccess()
    {
        $endpoint       = 'repositories/gentle/eof/issues/milestones/3';

        /** @var $milestone \Bitbucket\API\Repositories\Issues\Milestones */
        $milestone = $this->getApiMock('Bitbucket\API\Repositories\Issues\Milestones');

        $milestone->delete('gentle', 'eof', 3);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('DELETE', $request->getMethod());
    }
}
