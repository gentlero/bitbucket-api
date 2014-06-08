<?php

namespace Bitbucket\Tests\API\Repositories;

use Bitbucket\Tests\API as Tests;
use Bitbucket\API;

/**
 * Class PullRequestsTest
 */
class PullRequestsTest extends Tests\TestCase
{
    public function testGetAllPullRequests()
    {
        $endpoint       = 'repositories/gentle/eof/pullrequests';
        $expectedResult = $this->fakeResponse(array('dummy'));

        $client = $this->getHttpClientMock();
        $client->expects($this->once())
            ->method('get')
            ->with($endpoint)
            ->will($this->returnValue($expectedResult));

        /** @var \Bitbucket\API\Repositories\PullRequests $pull */
        $pull   = $this->getClassMock('Bitbucket\API\Repositories\PullRequests', $client);
        $actual = $pull->all('gentle', 'eof');

        $this->assertEquals($expectedResult, $actual);
    }

    public function testCreateNewPullRequestFromJSON()
    {
        $endpoint       = 'repositories/gentle/eof/pullrequests';
        $params         = json_encode(array(
            'title'         => 'Test PR',
            'source'        => array(
                'branch'    => array(
                    'name'  => 'quickfix-1'
                ),
                'repository' => array(
                    'full_name' => 'vimishor/secret-repo'
                )
            ),
            'destination'   => array(
                'branch'    => array(
                    'name'  => 'master'
                )
            )
        ));

        $client = $this->getHttpClientMock();
        $client->expects($this->once())
            ->method('post')
            ->with($endpoint, $params);

        /** @var \Bitbucket\API\Repositories\PullRequests $pull */
        $pull   = $this->getClassMock('Bitbucket\API\Repositories\PullRequests', $client);

        $pull->create('gentle', 'eof', $params);
    }

    public function testCreateNewPullRequestFromArray()
    {
        $endpoint       = 'repositories/gentle/eof/pullrequests';
        $params         = array(
                'title'         => 'Test PR',
                'source'        => array(
                    'branch'    => array(
                        'name'  => 'quickfix-1'
                    ),
                    'repository' => array(
                        'full_name' => 'vimishor/secret-repo'
                    )
                ),
                'destination'   => array(
                    'branch'    => array(
                        'name'  => 'master'
                    )
                ),
            );

        $client = $this->getHttpClientMock();
        $client->expects($this->once())
            ->method('post')
            ->with($endpoint, json_encode($params));

        /** @var \Bitbucket\API\Repositories\PullRequests $pull */
        $pull   = $this->getClassMock('Bitbucket\API\Repositories\PullRequests', $client);

        $pull->create('gentle', 'eof', $params);
    }

    public function testUpdatePullRequestFromJSON()
    {
        $endpoint       = 'repositories/gentle/eof/pullrequests/1';
        $params         = json_encode(array(
                'title'         => 'Test PR (updated)',
                'destination'   => array(
                    'branch'    => array(
                        'name'  => 'master'
                    )
                )
            ));

        $client = $this->getHttpClientMock();
        $client->expects($this->once())
            ->method('put')
            ->with($endpoint, $params);

        /** @var \Bitbucket\API\Repositories\PullRequests $pull */
        $pull   = $this->getClassMock('Bitbucket\API\Repositories\PullRequests', $client);

        $pull->update('gentle', 'eof', 1, $params);
    }

    public function testUpdatePullRequestFromArray()
    {
        $endpoint       = 'repositories/gentle/eof/pullrequests/1';
        $params         = array(
            'title'         => 'Test PR (updated)',
            'destination'   => array(
                'branch'    => array(
                    'name'  => 'master'
                )
            ),
        );

        $client = $this->getHttpClientMock();
        $client->expects($this->once())
            ->method('put')
            ->with($endpoint, json_encode($params));

        /** @var \Bitbucket\API\Repositories\PullRequests $pull */
        $pull   = $this->getClassMock('Bitbucket\API\Repositories\PullRequests', $client);

        $pull->update('gentle', 'eof', 1, $params);
    }

    public function testGetSpecificPullRequest()
    {
        $endpoint       = 'repositories/gentle/eof/pullrequests/1';
        $expectedResult = $this->fakeResponse(array('dummy'));

        $client = $this->getHttpClientMock();
        $client->expects($this->once())
            ->method('get')
            ->with($endpoint)
            ->will($this->returnValue($expectedResult));

        /** @var \Bitbucket\API\Repositories\PullRequests $pull */
        $pull   = $this->getClassMock('Bitbucket\API\Repositories\PullRequests', $client);
        $actual = $pull->get('gentle', 'eof', 1);

        $this->assertEquals($expectedResult, $actual);
    }

    public function testGetCommitsForSpecificPullRequest()
    {
        $endpoint       = 'repositories/gentle/eof/pullrequests/1/commits';
        $expectedResult = $this->fakeResponse(array('dummy'));

        $client = $this->getHttpClientMock();
        $client->expects($this->once())
            ->method('get')
            ->with($endpoint)
            ->will($this->returnValue($expectedResult));

        /** @var \Bitbucket\API\Repositories\PullRequests $pull */
        $pull   = $this->getClassMock('Bitbucket\API\Repositories\PullRequests', $client);
        $actual = $pull->commits('gentle', 'eof', 1);

        $this->assertEquals($expectedResult, $actual);
    }

    public function testApproveAPullRequest()
    {
        $endpoint       = 'repositories/gentle/eof/pullrequests/1/approve';

        $client = $this->getHttpClientMock();
        $client->expects($this->once())
            ->method('post')
            ->with($endpoint);

        /** @var \Bitbucket\API\Repositories\PullRequests $pull */
        $pull   = $this->getClassMock('Bitbucket\API\Repositories\PullRequests', $client);

        $pull->approve('gentle', 'eof', 1);
    }

    public function testDeletePullRequestApproval()
    {
        $endpoint       = 'repositories/gentle/eof/pullrequests/1/approve';

        $client = $this->getHttpClientMock();
        $client->expects($this->once())
            ->method('delete')
            ->with($endpoint);

        /** @var \Bitbucket\API\Repositories\PullRequests $pull */
        $pull   = $this->getClassMock('Bitbucket\API\Repositories\PullRequests', $client);

        $pull->deleteApproval('gentle', 'eof', 1);
    }

    public function testGetPullRequestDiff()
    {
        $endpoint       = 'repositories/gentle/eof/pullrequests/1/diff';
        $expectedResult = $this->fakeResponse(array('dummy'));

        $client = $this->getHttpClientMock();
        $client->expects($this->once())
            ->method('get')
            ->with($endpoint)
            ->will($this->returnValue($expectedResult));

        /** @var \Bitbucket\API\Repositories\PullRequests $pull */
        $pull   = $this->getClassMock('Bitbucket\API\Repositories\PullRequests', $client);
        $actual = $pull->diff('gentle', 'eof', 1);

        $this->assertEquals($expectedResult, $actual);
    }

    public function testGetPullRequestActivity()
    {
        $endpoint       = 'repositories/gentle/eof/pullrequests/1/activity';
        $expectedResult = $this->fakeResponse(array('dummy'));

        $client = $this->getHttpClientMock();
        $client->expects($this->once())
            ->method('get')
            ->with($endpoint)
            ->will($this->returnValue($expectedResult));

        /** @var \Bitbucket\API\Repositories\PullRequests $pull */
        $pull   = $this->getClassMock('Bitbucket\API\Repositories\PullRequests', $client);
        $actual = $pull->activity('gentle', 'eof', 1);

        $this->assertEquals($expectedResult, $actual);
    }

    public function testGetRepositoryPullRequestActivity()
    {
        $endpoint       = 'repositories/gentle/eof/pullrequests/activity';
        $expectedResult = $this->fakeResponse(array('dummy'));

        $client = $this->getHttpClientMock();
        $client->expects($this->once())
            ->method('get')
            ->with($endpoint)
            ->will($this->returnValue($expectedResult));

        /** @var \Bitbucket\API\Repositories\PullRequests $pull */
        $pull   = $this->getClassMock('Bitbucket\API\Repositories\PullRequests', $client);
        $actual = $pull->activity('gentle', 'eof');

        $this->assertEquals($expectedResult, $actual);
    }

    public function testAcceptAndMergeAPullRequest()
    {
        $endpoint   = 'repositories/gentle/eof/pullrequests/1/merge';
        $params     = array(
            'message'               => 'Lacks documentation.',
            'close_source_branch'   => false
        );

        $client = $this->getHttpClientMock();
        $client->expects($this->once())
            ->method('post')
            ->with($endpoint, json_encode($params));

        /** @var \Bitbucket\API\Repositories\PullRequests $pull */
        $pull   = $this->getClassMock('Bitbucket\API\Repositories\PullRequests', $client);

        $pull->accept('gentle', 'eof', 1, $params);
    }

    public function testDeclineAPullRequest()
    {
        $endpoint   = 'repositories/gentle/eof/pullrequests/1/decline';
        $params     = array(
            'message' => 'Please update the test suite.',
        );

        $client = $this->getHttpClientMock();
        $client->expects($this->once())
            ->method('post')
            ->with($endpoint, json_encode($params));

        /** @var \Bitbucket\API\Repositories\PullRequests $pull */
        $pull   = $this->getClassMock('Bitbucket\API\Repositories\PullRequests', $client);

        $pull->decline('gentle', 'eof', 1, $params);
    }
}
