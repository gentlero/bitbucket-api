<?php

namespace Gentle\Bitbucket\Tests\API\Repo\Changesets;

use Gentle\Bitbucket\Tests\API as Tests;
use Gentle\Bitbucket\API;

class CommentsTest extends Tests\TestCase
{
    public function testGetAllCommentsSuccess()
    {
        $endpoint       = 'repositories/gentle/eof/changesets/aea95f1/comments';
        $expectedResult = json_encode('dummy');

        $comments = $this->getApiMock('Gentle\Bitbucket\API\Repo\Changesets\Comments');
        $comments->expects($this->once())
            ->method('requestGet')
            ->with($endpoint)
            ->will( $this->returnValue($expectedResult) );

        /** @var $comments \Gentle\Bitbucket\API\Repo\Changesets\Comments */
        $actual = $comments->all('gentle', 'eof', 'aea95f1');

        $this->assertEquals($expectedResult, $actual);
    }

    public function testDeleteCommentSuccess()
    {
        $endpoint       = 'repositories/gentle/eof/changesets/aea95f1/comments/3';

        $comments = $this->getApiMock('Gentle\Bitbucket\API\Repo\Changesets\Comments');
        $comments->expects($this->once())
            ->method('requestDelete')
            ->with($endpoint);

        /** @var $comments \Gentle\Bitbucket\API\Repo\Changesets\Comments */
        $comments->delete('gentle', 'eof', 'aea95f1', 3);
    }
}