<?php

namespace Bitbucket\Tests\API\Repositories\PullRequest;

use Bitbucket\Tests\API as Tests;
use Bitbucket\API;

class CommitsTest extends Tests\TestCase
{
    public function testGetAllComments()
    {
        $endpoint       = 'repositories/gentle/eof/commit/SHA1/comments';
        $expectedResult = $this->addFakeResponse(array('dummy'));

        /** @var \Bitbucket\API\Repositories\Commits\Comments $comments */
        $comments   = $this->getApiMock('Bitbucket\API\Repositories\Commits\Comments');
        $actual     = $comments->all('gentle', 'eof', 'SHA1');

        $this->assertEquals($expectedResult, $actual);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/2.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('GET', $request->getMethod());
    }

    public function testGetSingleComment()
    {
        $endpoint       = 'repositories/gentle/eof/commit/SHA1/comments/1';
        $expectedResult = $this->addFakeResponse(array('dummy'));

        /** @var \Bitbucket\API\Repositories\Commits\Comments $comments */
        $comments   = $this->getApiMock('Bitbucket\API\Repositories\Commits\Comments');
        $actual     = $comments->get('gentle', 'eof', 'SHA1', 1);

        $this->assertEquals($expectedResult, $actual);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/2.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('GET', $request->getMethod());
    }
}
