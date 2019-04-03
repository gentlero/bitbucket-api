<?php

namespace Bitbucket\Tests\API\Repositories\PullRequest;

use Bitbucket\Tests\API as Tests;
use Bitbucket\API;

class CommentsTest extends Tests\TestCase
{
    public function testGetAllComments()
    {
        $endpoint       = 'repositories/gentle/eof/pullrequests/3/comments';
        $expectedResult = $this->fakeResponse(array('dummy'));

        $client = $this->getHttpClientMock();
        $client->expects($this->once())
            ->method('get')
            ->with($endpoint)
            ->will($this->returnValue($expectedResult));

        /** @var \Bitbucket\API\Repositories\PullRequests\Comments $comments */
        $comments   = $this->getClassMock('Bitbucket\API\Repositories\PullRequests\Comments', $client);
        $actual     = $comments->all('gentle', 'eof', 3);

        $this->assertEquals($expectedResult, $actual);
    }

    public function testGetSingleComment()
    {
        $endpoint       = 'repositories/gentle/eof/pullrequests/3/comments/1';
        $expectedResult = $this->fakeResponse(array('dummy'));

        $client = $this->getHttpClientMock();
        $client->expects($this->once())
            ->method('get')
            ->with($endpoint)
            ->will($this->returnValue($expectedResult));

        /** @var \Bitbucket\API\Repositories\PullRequests\Comments $comments */
        $comments   = $this->getClassMock('Bitbucket\API\Repositories\PullRequests\Comments', $client);
        $actual     = $comments->get('gentle', 'eof', 3, 1);

        $this->assertEquals($expectedResult, $actual);
    }

    public function testCreateCommentSuccess()
    {
        $endpoint       = 'repositories/gentle/eof/pullrequests/1/comments';
        $expectedResult = $this->fakeResponse(array('dummy'));

        $client = $this->getHttpClientMock();
        $client->expects($this->once())
            ->method('post')
            ->with($endpoint)
            ->will($this->returnValue($expectedResult));

        /** @var \Bitbucket\API\Repositories\PullRequests\Comments $comments */
        $comments = $this->getClassMock('Bitbucket\API\Repositories\PullRequests\Comments', $client);
        $actual   = $comments->create('gentle', 'eof', 1, 'test');

        $this->assertEquals($expectedResult, $actual);
    }

    public function testUpdateCommentSuccess()
    {
        $endpoint       = 'repositories/gentle/eof/pullrequests/1/comments/3';
        $expectedResult = array('content' => 'dummy');

        $client = $this->getHttpClientMock();
        $client->expects($this->once())
            ->method('put')
            ->with($endpoint)
            ->will($this->returnValue($expectedResult));

        /** @var \Bitbucket\API\Repositories\PullRequests\Comments $comments */
        $comments = $this->getClassMock('Bitbucket\API\Repositories\PullRequests\Comments', $client);
        $actual   = $comments->update('gentle', 'eof', 1, 3, 'dummy');

        $this->assertEquals($expectedResult, $actual);
    }

    public function testDeleteCommentSuccess()
    {
        $endpoint = 'repositories/gentle/eof/pullrequests/1/comments/2';

        $client = $this->getHttpClientMock();
        $client->expects($this->once())
            ->method('delete')
            ->with($endpoint);

        /** @var \Bitbucket\API\Repositories\PullRequests\Comments $comments */
        $comments = $this->getClassMock('Bitbucket\API\Repositories\PullRequests\Comments', $client);
        $comments->delete('gentle', 'eof', 1, 2);
    }
}
