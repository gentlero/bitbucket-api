<?php

namespace Bitbucket\Tests\API\Repositories\Issues;

use Bitbucket\Tests\API as Tests;
use Bitbucket\API;

class CommentsTest extends Tests\TestCase
{
    public function testGetSingleCommentSuccess()
    {
        $endpoint       = 'repositories/gentle/eof/issues/3/comments/2967835';
        $expectedResult = $this->addFakeResponse(json_encode('dummy'));

        /** @var $comments \Bitbucket\API\Repositories\Issues\Comments */
        $comments = $this->getApiMock('Bitbucket\API\Repositories\Issues\Comments');

        $actual = $comments->get('gentle', 'eof', 3, 2967835);

        $this->assertEquals($expectedResult, $actual);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('GET', $request->getMethod());
    }

    public function testGetAllCommentsSuccess()
    {
        $endpoint       = 'repositories/gentle/eof/issues/3/comments';
        $expectedResult = $this->addFakeResponse(json_encode('dummy'));

        /** @var $comments \Bitbucket\API\Repositories\Issues\Comments */
        $comments = $this->getApiMock('Bitbucket\API\Repositories\Issues\Comments');

        $actual = $comments->all('gentle', 'eof', 3);

        $this->assertEquals($expectedResult, $actual);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('GET', $request->getMethod());
    }

    public function testCreateCommentSuccess()
    {
        $endpoint       = 'repositories/gentle/eof/issues/2/comments';

        /** @var $comments \Bitbucket\API\Repositories\Issues\Comments */
        $comments = $this->getApiMock('Bitbucket\API\Repositories\Issues\Comments');

        $comments->create('gentle', 'eof', '2', 'dummy');

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('POST', $request->getMethod());
        $this->assertSame('content=dummy', $request->getBody()->getContents());
    }

    public function testUpdateCommentSuccess()
    {
        $endpoint       = 'repositories/gentle/eof/issues/2/comments/3';

        /** @var $comments \Bitbucket\API\Repositories\Issues\Comments */
        $comments = $this->getApiMock('Bitbucket\API\Repositories\Issues\Comments');

        $comments->update('gentle', 'eof', 2, 3, 'dummy');

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('PUT', $request->getMethod());
        $this->assertSame('content=dummy', $request->getBody()->getContents());
    }
}
