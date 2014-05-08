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
        $params         = array(
            'content'   => 'dummy comment'
        );

        $comment = $this->getApiMock('Bitbucket\API\Repositories\PullRequests\Comments');
        $comment->expects($this->once())
            ->method('requestPost')
            ->with($endpoint, $params);

        /** @var $comment \Bitbucket\API\Repositories\PullRequests\Comments */
        $comment->create('gentle', 'eof', 1, 'dummy comment');
    }

    public function testUpdateCommentSuccess()
    {
        $endpoint       = 'repositories/gentle/eof/pullrequests/1/comments/3';
        $params         = array('content' => 'dummy');

        $comment = $this->getApiMock('Bitbucket\API\Repositories\PullRequests\Comments');
        $comment->expects($this->once())
            ->method('requestPut')
            ->with($endpoint, $params);

        /** @var $comment \Bitbucket\API\Repositories\PullRequests\Comments */
        $comment->update('gentle', 'eof', 1, 3, 'dummy');
    }

    public function testDeleteCommentSuccess()
    {
        $endpoint       = 'repositories/gentle/eof/pullrequests/1/comments/2';

        $comment = $this->getApiMock('Bitbucket\API\Repositories\PullRequests\Comments');
        $comment->expects($this->once())
            ->method('requestDelete')
            ->with($endpoint);

        /** @var $comment \Bitbucket\API\Repositories\PullRequests\Comments */
        $comment->delete('gentle', 'eof', 1, 2);
    }
}
