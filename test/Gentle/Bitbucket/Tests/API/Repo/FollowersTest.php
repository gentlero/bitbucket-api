<?php

namespace Gentle\Bitbucket\Tests\API\Repo;

use Gentle\Bitbucket\Tests\API as Tests;
use Gentle\Bitbucket\API;

class FollowersTest extends Tests\TestCase
{
    public function testGetFollowers()
    {
        $endpoint       = 'repositories/gentle/eof/followers';
        $expectedResult = json_encode('dummy');

        $followers = $this->getApiMock('Gentle\Bitbucket\API\Repo\Followers');
        $followers->expects($this->once())
            ->method('requestGet')
            ->with($endpoint)
            ->will( $this->returnValue($expectedResult) );

        /** @var $followers \Gentle\Bitbucket\API\Repo\Followers */
        $actual = $followers->all('gentle', 'eof');

        $this->assertEquals($expectedResult, $actual);
    }
}