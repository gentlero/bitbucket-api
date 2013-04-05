<?php

namespace Gentle\Bitbucket\Tests\API\Repo\PullRequest;

use Gentle\Bitbucket\Tests\API as Tests;
use Gentle\Bitbucket\API;

class CommentsTest extends Tests\TestCase
{
    public function testGetAllComments()
    {
        $endpoint       = 'repositories/gentle/eof/pullrequests/3/comments';
        $expectedResult = json_encode('dummy');

        $comments = $this->getApiMock('Gentle\Bitbucket\API\Repo\PullRequest\Comments');
        $comments->expects($this->once())
            ->method('requestGet')
            ->with($endpoint)
            ->will( $this->returnValue($expectedResult) );

        /** @var $comments \Gentle\Bitbucket\API\Repo\PullRequest\Comments */
        $actual = $comments->all('gentle', 'eof', 3);

        $this->assertEquals($expectedResult, $actual);
    }

    public function testGetSingleComment()
    {
        $endpoint       = 'repositories/gentle/eof/pullrequests/3/comments/1';
        $expectedResult = json_encode('dummy');

        $comment = $this->getApiMock('Gentle\Bitbucket\API\Repo\PullRequest\Comments');
        $comment->expects($this->once())
            ->method('requestGet')
            ->with($endpoint)
            ->will( $this->returnValue($expectedResult) );

        /** @var $comment \Gentle\Bitbucket\API\Repo\PullRequest\Comments */
        $actual = $comment->get('gentle', 'eof', 3, 1);

        $this->assertEquals($expectedResult, $actual);
    }
}