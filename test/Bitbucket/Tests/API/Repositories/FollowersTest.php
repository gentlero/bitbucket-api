<?php

namespace Bitbucket\Tests\API\Repositories;

use Bitbucket\Tests\API as Tests;
use Bitbucket\API;

class FollowersTest extends Tests\TestCase
{
    public function testGetFollowers()
    {
        $endpoint       = 'repositories/gentle/eof/followers';
        $expectedResult = json_encode('dummy');

        $followers = $this->getApiMock('Bitbucket\API\Repositories\Followers');
        $followers->expects($this->once())
            ->method('requestGet')
            ->with($endpoint)
            ->will( $this->returnValue($expectedResult) );

        /** @var $followers \Bitbucket\API\Repositories\Followers */
        $actual = $followers->all('gentle', 'eof');

        $this->assertEquals($expectedResult, $actual);
    }
}