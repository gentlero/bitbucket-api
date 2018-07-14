<?php

namespace Bitbucket\Tests\API\Repositories\PullRequest;

use Bitbucket\Tests\API as Tests;
use Bitbucket\API;

class CommentsTest extends Tests\TestCase
{
    public function testGetAllComments()
    {
        $endpoint       = 'repositories/gentle/eof/pullrequests/3/comments';
        $expectedResult = $this->addFakeResponse(array('dummy'));

        /** @var \Bitbucket\API\Repositories\PullRequests\Comments $comments */
        $comments   = $this->getApiMock('Bitbucket\API\Repositories\PullRequests\Comments');
        $actual     = $comments->all('gentle', 'eof', 3);

        $this->assertEquals($expectedResult, $actual);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/2.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('GET', $request->getMethod());
    }

    public function testGetSingleComment()
    {
        $endpoint       = 'repositories/gentle/eof/pullrequests/3/comments/1';
        $expectedResult = $this->addFakeResponse(array('dummy'));

        /** @var \Bitbucket\API\Repositories\PullRequests\Comments $comments */
        $comments   = $this->getApiMock('Bitbucket\API\Repositories\PullRequests\Comments');
        $actual     = $comments->get('gentle', 'eof', 3, 1);

        $this->assertEquals($expectedResult, $actual);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/2.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('GET', $request->getMethod());
    }

    public function testCreateCommentSuccess()
    {
        $endpoint       = 'repositories/gentle/eof/pullrequests/1/comments';

        /** @var $comment \Bitbucket\API\Repositories\PullRequests\Comments */
        $comment = $this->getApiMock('Bitbucket\API\Repositories\PullRequests\Comments');

        $comment->create('gentle', 'eof', 1, 'dummy comment');

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('POST', $request->getMethod());
        $this->assertSame('content=dummy+comment', $request->getBody()->getContents());
    }

    public function testUpdateCommentSuccess()
    {
        $endpoint       = 'repositories/gentle/eof/pullrequests/1/comments/3';

        /** @var $comment \Bitbucket\API\Repositories\PullRequests\Comments */
        $comment = $this->getApiMock('Bitbucket\API\Repositories\PullRequests\Comments');

        $comment->update('gentle', 'eof', 1, 3, 'dummy');

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('PUT', $request->getMethod());
        $this->assertSame('content=dummy', $request->getBody()->getContents());
    }

    public function testDeleteCommentSuccess()
    {
        $endpoint       = 'repositories/gentle/eof/pullrequests/1/comments/2';

        /** @var $comment \Bitbucket\API\Repositories\PullRequests\Comments */
        $comment = $this->getApiMock('Bitbucket\API\Repositories\PullRequests\Comments');

        $comment->delete('gentle', 'eof', 1, 2);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('DELETE', $request->getMethod());
    }
}
