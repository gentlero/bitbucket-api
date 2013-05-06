<?php

namespace Bitbucket\Tests\API\Repositories\Issues;

use Bitbucket\Tests\API as Tests;
use Bitbucket\API;

class CommentsTest extends Tests\TestCase
{
    public function testGetSingleCommentSuccess()
    {
        $endpoint       = 'repositories/gentle/eof/issues/3/comments/2967835';
        $expectedResult = json_encode('dummy');

        $comments = $this->getApiMock('Bitbucket\API\Repositories\Issues\Comments');
        $comments->expects($this->once())
            ->method('requestGet')
            ->with($endpoint)
            ->will( $this->returnValue($expectedResult) );

        /** @var $comments \Bitbucket\API\Repositories\Issues\Comments */
        $actual = $comments->get('gentle', 'eof', 3, 2967835);

        $this->assertEquals($expectedResult, $actual);
    }

    public function testGetAllCommentsSuccess()
    {
        $endpoint       = 'repositories/gentle/eof/issues/3/comments';
        $expectedResult = json_encode('dummy');

        $comments = $this->getApiMock('Bitbucket\API\Repositories\Issues\Comments');
        $comments->expects($this->once())
            ->method('requestGet')
            ->with($endpoint)
            ->will( $this->returnValue($expectedResult) );

        /** @var $comments \Bitbucket\API\Repositories\Issues\Comments */
        $actual = $comments->all('gentle', 'eof', 3);

        $this->assertEquals($expectedResult, $actual);
    }

    public function testCreateCommentSuccess()
    {
        $endpoint       = 'repositories/gentle/eof/issues/2/comments';
        $params         = array('content' => 'dummy');

        $comments = $this->getApiMock('Bitbucket\API\Repositories\Issues\Comments');
        $comments->expects($this->once())
            ->method('requestPost')
            ->with($endpoint, $params);

        /** @var $comments \Bitbucket\API\Repositories\Issues\Comments */
        $comments->create('gentle', 'eof', '2', 'dummy');
    }

    public function testUpdateCommentSuccess()
    {
        $endpoint       = 'repositories/gentle/eof/issues/2/comments/3';
        $params         = array('content' => 'dummy');

        $comments = $this->getApiMock('Bitbucket\API\Repositories\Issues\Comments');
        $comments->expects($this->once())
            ->method('requestPut')
            ->with($endpoint, $params);

        /** @var $comments \Bitbucket\API\Repositories\Issues\Comments */
        $comments->update('gentle', 'eof', 2, 3, 'dummy');
    }
}