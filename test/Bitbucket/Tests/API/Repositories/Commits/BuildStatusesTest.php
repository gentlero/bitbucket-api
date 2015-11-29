<?php

namespace Bitbucket\Tests\API\Repositories\Commits\Statuses;

use Bitbucket\Tests\API as Tests;
use Bitbucket\API;

class BuildStatusesTest extends Tests\TestCase
{
    public function testGet()
    {
        $endpoint = 'repositories/gentle/eof/commit/SHA1/statuses/build/KEY';
        $expectedResult = $this->fakeResponse(array('dummy'));

        $client = $this->getHttpClientMock();
        $client->expects($this->once())
            ->method('get')
            ->with($endpoint)
            ->will($this->returnValue($expectedResult));

        /** @var \Bitbucket\API\Repositories\Commits\BuildStatuses $buildStatus */
        $buildStatus = $this->getClassMock('Bitbucket\API\Repositories\Commits\BuildStatuses', $client);
        $actual = $buildStatus->get('gentle', 'eof', 'SHA1', 'KEY');

        $this->assertEquals($expectedResult, $actual);
    }

    public function testCreate()
    {
        $endpoint = 'repositories/gentle/eof/commit/SHA1/statuses/build';
        $params = json_encode(array(
            'state' => 'SUCCESSFUL'
        ));

        $client = $this->getHttpClientMock();
        $client->expects($this->once())
            ->method('post')
            ->with($endpoint);

        /** @var \Bitbucket\API\Repositories\Commits\BuildStatuses $buildStatus */
        $buildStatus = $this->getClassMock('Bitbucket\API\Repositories\Commits\BuildStatuses', $client);

        $buildStatus->create('gentle', 'eof', 'SHA1', $params);
    }

    public function testUpdate()
    {
        $endpoint = 'repositories/gentle/eof/commit/SHA1/statuses/build/KEY';
        $params = json_encode(array(
            'state' => 'SUCCESSFUL'
        ));

        $client = $this->getHttpClientMock();
        $client->expects($this->once())
            ->method('put')
            ->with($endpoint);

        /** @var \Bitbucket\API\Repositories\Commits\BuildStatuses $buildStatus */
        $buildStatus = $this->getClassMock('Bitbucket\API\Repositories\Commits\BuildStatuses', $client);

        $buildStatus->update('gentle', 'eof', 'SHA1', 'KEY', $params);
    }
}
