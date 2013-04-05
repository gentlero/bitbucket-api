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
}