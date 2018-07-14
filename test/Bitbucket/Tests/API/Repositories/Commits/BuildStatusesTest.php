<?php

namespace Bitbucket\Tests\API\Repositories\Commits\Statuses;

use Bitbucket\Tests\API as Tests;
use Bitbucket\API;

class BuildStatusesTest extends Tests\TestCase
{
    public function testGet()
    {
        $endpoint = 'repositories/gentle/eof/commit/SHA1/statuses/build/KEY';
        $expectedResult = $this->addFakeResponse(array('dummy'));

        /** @var \Bitbucket\API\Repositories\Commits\BuildStatuses $buildStatus */
        $buildStatus = $this->getApiMock('Bitbucket\API\Repositories\Commits\BuildStatuses');
        $actual = $buildStatus->get('gentle', 'eof', 'SHA1', 'KEY');

        $this->assertEquals($expectedResult, $actual);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/2.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('GET', $request->getMethod());
    }

    public function testCreate()
    {
        $endpoint = 'repositories/gentle/eof/commit/SHA1/statuses/build';
        $params = array(
            'state' => 'SUCCESSFUL'
        );

        /** @var \Bitbucket\API\Repositories\Commits\BuildStatuses $buildStatus */
        $buildStatus = $this->getApiMock('Bitbucket\API\Repositories\Commits\BuildStatuses');

        $buildStatus->create('gentle', 'eof', 'SHA1', $params);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/2.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('POST', $request->getMethod());
        $this->assertSame(json_encode($params), $request->getBody()->getContents());
        $this->assertSame(['application/json'], $request->getHeader('Content-Type'));
    }

    public function testUpdate()
    {
        $endpoint = 'repositories/gentle/eof/commit/SHA1/statuses/build/KEY';
        $params = array(
            'state' => 'SUCCESSFUL'
        );

        /** @var \Bitbucket\API\Repositories\Commits\BuildStatuses $buildStatus */
        $buildStatus = $this->getApiMock('Bitbucket\API\Repositories\Commits\BuildStatuses');

        $buildStatus->update('gentle', 'eof', 'SHA1', 'KEY', $params);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/2.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('PUT', $request->getMethod());
        $this->assertSame(json_encode($params), $request->getBody()->getContents());
        $this->assertSame(['application/json'], $request->getHeader('Content-Type'));
    }
}
