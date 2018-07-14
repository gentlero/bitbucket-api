<?php

namespace Bitbucket\Tests\API\Repositories;

use Bitbucket\Tests\API as Tests;
use Bitbucket\API;

class CommitsTest extends Tests\TestCase
{
    public function testGetAllRepositoryCommits()
    {
        $endpoint       = 'repositories/gentle/eof/commits';
        $expectedResult = $this->addFakeResponse(array('dummy'));

        /** @var \Bitbucket\API\Repositories\Commits $commits */
        $commits    = $this->getApiMock('Bitbucket\API\Repositories\Commits');
        $actual     = $commits->all('gentle', 'eof', array('dummy'));

        $this->assertEquals($expectedResult, $actual);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/2.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('GET', $request->getMethod());
    }

    public function testGetAllRepositoryCommitsFromSpecificBranch()
    {
        $endpoint       = 'repositories/gentle/eof/commits/master';
        $expectedResult = $this->addFakeResponse(array('dummy', 'branch' => 'master'));

        /** @var \Bitbucket\API\Repositories\Commits $commits */
        $commits    = $this->getApiMock('Bitbucket\API\Repositories\Commits');
        $actual     = $commits->all('gentle', 'eof', array('dummy', 'branch' => 'master'));

        $this->assertEquals($expectedResult, $actual);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/2.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('GET', $request->getMethod());
    }

    public function testGetSingleCommitInfo()
    {
        $endpoint       = 'repositories/gentle/eof/commit/SHA';
        $expectedResult = $this->addFakeResponse(array('dummy'));

        /** @var \Bitbucket\API\Repositories\Commits $commits */
        $commits    = $this->getApiMock('Bitbucket\API\Repositories\Commits');
        $actual     = $commits->get('gentle', 'eof', 'SHA');

        $this->assertEquals($expectedResult, $actual);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/2.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('GET', $request->getMethod());
    }

    public function testApproveACommit()
    {
        $endpoint       = 'repositories/gentle/eof/commit/SHA1/approve';

        /** @var \Bitbucket\API\Repositories\Commits $commit */
        $commit   = $this->getApiMock('Bitbucket\API\Repositories\Commits');

        $commit->approve('gentle', 'eof', 'SHA1');

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/2.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('POST', $request->getMethod());
    }

    public function testDeleteCommitApproval()
    {
        $endpoint       = 'repositories/gentle/eof/commit/SHA1/approve';

        /** @var \Bitbucket\API\Repositories\Commits $commit */
        $commit   = $this->getApiMock('Bitbucket\API\Repositories\Commits');

        $commit->deleteApproval('gentle', 'eof', 'SHA1');

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/2.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('DELETE', $request->getMethod());
    }
}
