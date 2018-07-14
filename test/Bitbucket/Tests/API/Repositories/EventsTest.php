<?php

namespace Bitbucket\Tests\API\Repositories;

use Bitbucket\Tests\API as Tests;
use Bitbucket\API;

class EventsTest extends Tests\TestCase
{
    public function testGetEventsWithoutFilters()
    {
        $endpoint       = 'repositories/gentle/eof/events';
        $expectedResult = $this->addFakeResponse(json_encode('dummy'));

        /** @var $events \Bitbucket\API\Repositories\Events */
        $events = $this->getApiMock('Bitbucket\API\Repositories\Events');

        $actual = $events->all('gentle', 'eof');

        $this->assertEquals($expectedResult, $actual);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('GET', $request->getMethod());
    }

    public function testGetEventsWithLimit()
    {
        $endpoint       = 'repositories/gentle/eof/events';
        $params         = array('limit' => 10);
        $expectedResult = $this->addFakeResponse(json_encode('dummy'));

        /** @var $events \Bitbucket\API\Repositories\Events */
        $events = $this->getApiMock('Bitbucket\API\Repositories\Events');

        $actual = $events->all('gentle', 'eof', $params);

        $this->assertEquals($expectedResult, $actual);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('limit=10&format=json', $request->getUri()->getQuery());
        $this->assertSame('GET', $request->getMethod());
    }
}
