<?php

namespace Bitbucket\Tests\API\Repositories\PullRequest;

use Bitbucket\Tests\API as Tests;
use Bitbucket\API;

class CommitsTest extends Tests\TestCase
{
    public function testGetAllComments()
    {
        $endpoint       = 'repositories/gentle/eof/commit/SHA1/comments';
        $expectedResult = $this->fakeResponse(array('dummy'));

        $client = $this->getHttpClientMock();
        $client->expects($this->once())
            ->method('get')
            ->with($endpoint)
            ->will($this->returnValue($expectedResult));

        /** @var \Bitbucket\API\Repositories\Commits\Comments $comments */
        $comments   = $this->getClassMock('Bitbucket\API\Repositories\Commits\Comments', $client);
        $actual     = $comments->all('gentle', 'eof', 'SHA1');

        $this->assertEquals($expectedResult, $actual);
    }

    public function testGetSingleComment()
    {
        $endpoint       = 'repositories/gentle/eof/commit/SHA1/comments/1';
        $expectedResult = $this->fakeResponse(array('dummy'));

        $client = $this->getHttpClientMock();
        $client->expects($this->once())
            ->method('get')
            ->with($endpoint)
            ->will($this->returnValue($expectedResult));

        /** @var \Bitbucket\API\Repositories\Commits\Comments $comments */
        $comments   = $this->getClassMock('Bitbucket\API\Repositories\Commits\Comments', $client);
        $actual     = $comments->get('gentle', 'eof', 'SHA1', 1);

        $this->assertEquals($expectedResult, $actual);
    }
}
