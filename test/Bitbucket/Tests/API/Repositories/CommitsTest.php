<?php

namespace Bitbucket\Tests\API\Repositories;

use Bitbucket\Tests\API as Tests;
use Bitbucket\API;

class CommitsTest extends Tests\TestCase
{
    public function testGetAllRepositoryCommits()
    {
        $endpoint       = 'repositories/gentle/eof/commits';
        $expectedResult = $this->fakeResponse(array('dummy'));

        $client = $this->getHttpClientMock();
        $client->expects($this->once())
            ->method('post')
            ->with($endpoint)
            ->will($this->returnValue($expectedResult));

        /** @var \Bitbucket\API\Repositories\Commits $commits */
        $commits    = $this->getClassMock('Bitbucket\API\Repositories\Commits', $client);
        $actual     = $commits->all('gentle', 'eof', array('dummy'));

        $this->assertEquals($expectedResult, $actual);
    }

    public function testGetAllRepositoryCommitsFromSpecificBranch()
    {
        $endpoint       = 'repositories/gentle/eof/commits/master';
        $expectedResult = $this->fakeResponse(array('dummy', 'branch' => 'master'));

        $client = $this->getHttpClientMock();
        $client->expects($this->once())
            ->method('post')
            ->with($endpoint)
            ->will($this->returnValue($expectedResult));

        /** @var \Bitbucket\API\Repositories\Commits $commits */
        $commits    = $this->getClassMock('Bitbucket\API\Repositories\Commits', $client);
        $actual     = $commits->all('gentle', 'eof', array('dummy', 'branch' => 'master'));

        $this->assertEquals($expectedResult, $actual);
    }

    public function testGetSingleCommitInfo()
    {
        $endpoint       = 'repositories/gentle/eof/commit/SHA';
        $expectedResult = $this->fakeResponse(array('dummy'));

        $client = $this->getHttpClientMock();
        $client->expects($this->once())
            ->method('get')
            ->with($endpoint)
            ->will($this->returnValue($expectedResult));

        /** @var \Bitbucket\API\Repositories\Commits $commits */
        $commits    = $this->getClassMock('Bitbucket\API\Repositories\Commits', $client);
        $actual     = $commits->get('gentle', 'eof', 'SHA');

        $this->assertEquals($expectedResult, $actual);
    }

    public function testApproveACommit()
    {
        $endpoint       = 'repositories/gentle/eof/commit/SHA1/approve';

        $client = $this->getHttpClientMock();
        $client->expects($this->once())
            ->method('post')
            ->with($endpoint);

        /** @var \Bitbucket\API\Repositories\Commits $commit */
        $commit   = $this->getClassMock('Bitbucket\API\Repositories\Commits', $client);

        $commit->approve('gentle', 'eof', 'SHA1');
    }

    public function testDeleteCommitApproval()
    {
        $endpoint       = 'repositories/gentle/eof/commit/SHA1/approve';

        $client = $this->getHttpClientMock();
        $client->expects($this->once())
            ->method('delete')
            ->with($endpoint);

        /** @var \Bitbucket\API\Repositories\Commits $commit */
        $commit   = $this->getClassMock('Bitbucket\API\Repositories\Commits', $client);

        $commit->deleteApproval('gentle', 'eof', 'SHA1');
    }
}
