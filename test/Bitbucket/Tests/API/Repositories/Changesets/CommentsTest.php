<?php

namespace Bitbucket\Tests\API\Repositories\Changesets;

use Bitbucket\Tests\API as Tests;
use Bitbucket\API;

class CommentsTest extends Tests\TestCase
{
    public function testGetAllCommentsSuccess()
    {
        $endpoint       = 'repositories/gentle/eof/changesets/aea95f1/comments';
        $expectedResult = json_encode('dummy');

        $comments = $this->getApiMock('Bitbucket\API\Repositories\Changesets\Comments');
        $comments->expects($this->once())
            ->method('requestGet')
            ->with($endpoint)
            ->will( $this->returnValue($expectedResult) );

        /** @var $comments \Bitbucket\API\Repositories\Changesets\Comments */
        $actual = $comments->all('gentle', 'eof', 'aea95f1');

        $this->assertEquals($expectedResult, $actual);
    }

    public function testDeleteCommentSuccess()
    {
        $endpoint       = 'repositories/gentle/eof/changesets/aea95f1/comments/3';

        $comments = $this->getApiMock('Bitbucket\API\Repositories\Changesets\Comments');
        $comments->expects($this->once())
            ->method('requestDelete')
            ->with($endpoint);

        /** @var $comments \Bitbucket\API\Repositories\Changesets\Comments */
        $comments->delete('gentle', 'eof', 'aea95f1', 3);
    }

    public function testCreateCommentSuccess()
    {
        $endpoint       = 'repositories/gentle/eof/changesets/aea95f1/comments';
        $params         = array('content' => 'dummy comment');

        $comments = $this->getApiMock('Bitbucket\API\Repositories\Changesets\Comments');
        $comments->expects($this->once())
            ->method('requestPost')
            ->with($endpoint, $params);

        /** @var $comments \Bitbucket\API\Repositories\Changesets\Comments */
        $comments->create('gentle', 'eof', 'aea95f1', 'dummy comment');
    }

    public function testUpdateCommentSuccess()
    {
        $endpoint       = 'repositories/gentle/eof/changesets/aea95f1/comments/3';
        $params         = array('content' => 'edited comment');

        $comments = $this->getApiMock('Bitbucket\API\Repositories\Changesets\Comments');
        $comments->expects($this->once())
            ->method('requestPut')
            ->with($endpoint, $params);

        /** @var $comments \Bitbucket\API\Repositories\Changesets\Comments */
        $comments->update('gentle', 'eof', 'aea95f1', 3, 'edited comment');
    }
}