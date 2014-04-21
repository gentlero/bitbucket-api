<?php

namespace Bitbucket\Tests\API\Repositories;

use Bitbucket\Tests\API as Tests;
use Bitbucket\API;

/**
 * Class PullRequestsTest
 */
class PullRequestsTest extends Tests\TestCase
{
    public function testGetAllPullRequests()
    {
        $endpoint       = 'repositories/gentle/eof/pullrequests';
        $expectedResult = json_encode('dummy');

        $pullRequests = $this->getApiMock('Bitbucket\API\Repositories\PullRequests');
        $pullRequests->expects($this->once())
            ->method('requestGet')
            ->with($endpoint)
            ->will( $this->returnValue($expectedResult) );

        /** @var $pullRequests \Bitbucket\API\Repositories\PullRequests */
        $actual = $pullRequests->all('gentle', 'eof');

        $this->assertEquals($expectedResult, $actual);
    }
}