<?php

namespace Bitbucket\Tests\API\Repositories;

use Bitbucket\Tests\API as Tests;
use Bitbucket\API;

class EventsTest extends Tests\TestCase
{
    public function testGetEventsWithoutFilters()
    {
        $endpoint       = 'repositories/gentle/eof/events';
        $expectedResult = json_encode('dummy');

        $events = $this->getApiMock('Bitbucket\API\Repositories\Events');
        $events->expects($this->once())
            ->method('requestGet')
            ->with($endpoint)
            ->will( $this->returnValue($expectedResult) );

        /** @var $events \Bitbucket\API\Repositories\Events */
        $actual = $events->all('gentle', 'eof');

        $this->assertEquals($expectedResult, $actual);
    }

    public function testGetEventsWithLimit()
    {
        $endpoint       = 'repositories/gentle/eof/events';
        $params         = array('limit' => 10);
        $expectedResult = json_encode('dummy');

        $events = $this->getApiMock('Bitbucket\API\Repositories\Events');
        $events->expects($this->once())
            ->method('requestGet')
            ->with($endpoint, $params)
            ->will( $this->returnValue($expectedResult) );

        /** @var $events \Bitbucket\API\Repositories\Events */
        $actual = $events->all('gentle', 'eof', $params);

        $this->assertEquals($expectedResult, $actual);
    }
}