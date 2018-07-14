<?php

namespace Bitbucket\Tests\API\Repositories\Changesets;

use Bitbucket\Tests\API as Tests;
use Bitbucket\API;

class CommentsTest extends Tests\TestCase
{
    public function testGetAllCommentsSuccess()
    {
        $endpoint       = 'repositories/gentle/eof/changesets/aea95f1/comments';
        $expectedResult = $this->addFakeResponse(json_encode('dummy'));

        /** @var $comments \Bitbucket\API\Repositories\Changesets\Comments */
        $comments = $this->getApiMock('Bitbucket\API\Repositories\Changesets\Comments');

        $actual = $comments->all('gentle', 'eof', 'aea95f1');

        $this->assertEquals($expectedResult, $actual);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('GET', $request->getMethod());
    }

    public function testDeleteCommentSuccess()
    {
        $endpoint       = 'repositories/gentle/eof/changesets/aea95f1/comments/3';

        /** @var $comments \Bitbucket\API\Repositories\Changesets\Comments */
        $comments = $this->getApiMock('Bitbucket\API\Repositories\Changesets\Comments');

        $comments->delete('gentle', 'eof', 'aea95f1', 3);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('DELETE', $request->getMethod());
    }

    public function testCreateCommentSuccess()
    {
        $endpoint       = 'repositories/gentle/eof/changesets/aea95f1/comments';

        /** @var $comments \Bitbucket\API\Repositories\Changesets\Comments */
        $comments = $this->getApiMock('Bitbucket\API\Repositories\Changesets\Comments');

        $comments->create('gentle', 'eof', 'aea95f1', 'dummy comment');

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('POST', $request->getMethod());
        $this->assertSame('content=dummy+comment', $request->getBody()->getContents());
    }

    public function testUpdateCommentSuccess()
    {
        $endpoint       = 'repositories/gentle/eof/changesets/aea95f1/comments/3';

        /** @var $comments \Bitbucket\API\Repositories\Changesets\Comments */
        $comments = $this->getApiMock('Bitbucket\API\Repositories\Changesets\Comments');

        $comments->update('gentle', 'eof', 'aea95f1', 3, 'edited comment');

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('PUT', $request->getMethod());
        $this->assertSame('content=edited+comment', $request->getBody()->getContents());
    }

    public function testMarkCommentAsSpamSuccess()
    {
        $endpoint       = 'repositories/gentle/eof/changesets/aea95f1/comments/spam/3';

        /** @var $comments \Bitbucket\API\Repositories\Changesets\Comments */
        $comments = $this->getApiMock('Bitbucket\API\Repositories\Changesets\Comments');

        $comments->spam('gentle', 'eof', 'aea95f1', 3);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('PUT', $request->getMethod());
    }
}
