<?php

namespace Bitbucket\Tests\API\Repositories;

use Bitbucket\Tests\API as Tests;
use Bitbucket\API;

class FollowersTest extends Tests\TestCase
{
    public function testGetFollowers()
    {
        $endpoint       = 'repositories/gentle/eof/followers';
        $expectedResult = $this->addFakeResponse(json_encode('dummy'));

        /** @var $followers \Bitbucket\API\Repositories\Followers */
        $followers = $this->getApiMock('Bitbucket\API\Repositories\Followers');

        $actual = $followers->all('gentle', 'eof');

        $this->assertEquals($expectedResult, $actual);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('GET', $request->getMethod());
    }
}
