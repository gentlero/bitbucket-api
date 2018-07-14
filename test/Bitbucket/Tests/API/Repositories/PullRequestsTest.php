<?php

namespace Bitbucket\Tests\API\Repositories;

use Bitbucket\Tests\API as Tests;
use Bitbucket\API;
use Buzz\Message\RequestInterface;

/**
 * Class PullRequestsTest
 */
class PullRequestsTest extends Tests\TestCase
{
    public function testGetAllPullRequests()
    {
        $endpoint       = 'repositories/gentle/eof/pullrequests';
        $expectedResult = $this->addFakeResponse(array('dummy'));

        /** @var \Bitbucket\API\Repositories\PullRequests $pull */
        $pull   = $this->getApiMock('Bitbucket\API\Repositories\PullRequests');
        $actual = $pull->all('gentle', 'eof');

        $this->assertEquals($expectedResult, $actual);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/2.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('GET', $request->getMethod());
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

        /** @var \Bitbucket\API\Repositories\PullRequests $pull */
        $pull   = $this->getApiMock('Bitbucket\API\Repositories\PullRequests');

        $pull->create('gentle', 'eof', $params);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/2.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('POST', $request->getMethod());
        $this->assertSame($params, $request->getBody()->getContents());
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

        /** @var \Bitbucket\API\Repositories\PullRequests $pull */
        $pull   = $this->getApiMock('Bitbucket\API\Repositories\PullRequests');

        $pull->create('gentle', 'eof', $params);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/2.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('POST', $request->getMethod());
        $this->assertSame(json_encode($params), $request->getBody()->getContents());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testCreateNewPullRequestWithWrongParamsType()
    {
        /** @var \Bitbucket\API\Repositories\PullRequests $pull */
        $pull   = $this->getApiMock('Bitbucket\API\Repositories\PullRequests');

        $pull->create('gentle', 'eof', '');
        $pull->create('gentle', 'eof', 3);
        $pull->create('gentle', 'eof', "{ 'foo': 'bar' }");

        $this->assertNull($this->mockClient->getLastRequest());
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

        /** @var \Bitbucket\API\Repositories\PullRequests $pull */
        $pull   = $this->getApiMock('Bitbucket\API\Repositories\PullRequests');

        $pull->update('gentle', 'eof', 1, $params);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/2.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('PUT', $request->getMethod());
        $this->assertSame($params, $request->getBody()->getContents());
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

        /** @var \Bitbucket\API\Repositories\PullRequests $pull */
        $pull   = $this->getApiMock('Bitbucket\API\Repositories\PullRequests');

        $pull->update('gentle', 'eof', 1, $params);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/2.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('PUT', $request->getMethod());
        $this->assertSame(json_encode($params), $request->getBody()->getContents());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testUpdatePullRequestWithWrongParamsType()
    {
        /** @var \Bitbucket\API\Repositories\PullRequests $pull */
        $pull   = $this->getApiMock('Bitbucket\API\Repositories\PullRequests');

        $pull->update('gentle', 'eof', 1, '');
        $pull->update('gentle', 'eof', 1, 3);
        $pull->update('gentle', 'eof', 1, "{ 'foo': 'bar' }");

        $this->assertNull($this->mockClient->getLastRequest());
    }

    public function testGetSpecificPullRequest()
    {
        $endpoint       = 'repositories/gentle/eof/pullrequests/1';
        $expectedResult = $this->addFakeResponse(array('dummy'));

        /** @var \Bitbucket\API\Repositories\PullRequests $pull */
        $pull   = $this->getApiMock('Bitbucket\API\Repositories\PullRequests');
        $actual = $pull->get('gentle', 'eof', 1);

        $this->assertEquals($expectedResult, $actual);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/2.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('GET', $request->getMethod());
    }

    public function testGetCommitsForSpecificPullRequest()
    {
        $endpoint       = 'repositories/gentle/eof/pullrequests/1/commits';
        $expectedResult = $this->addFakeResponse(array('dummy'));

        /** @var \Bitbucket\API\Repositories\PullRequests $pull */
        $pull   = $this->getApiMock('Bitbucket\API\Repositories\PullRequests');
        $actual = $pull->commits('gentle', 'eof', 1);

        $this->assertEquals($expectedResult, $actual);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/2.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('GET', $request->getMethod());
    }

    public function testApproveAPullRequest()
    {
        $endpoint       = 'repositories/gentle/eof/pullrequests/1/approve';

        /** @var \Bitbucket\API\Repositories\PullRequests $pull */
        $pull   = $this->getApiMock('Bitbucket\API\Repositories\PullRequests');

        $pull->approve('gentle', 'eof', 1);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/2.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('POST', $request->getMethod());
    }

    public function testDeletePullRequestApproval()
    {
        $endpoint       = 'repositories/gentle/eof/pullrequests/1/approve';

        /** @var \Bitbucket\API\Repositories\PullRequests $pull */
        $pull   = $this->getApiMock('Bitbucket\API\Repositories\PullRequests');

        $pull->deleteApproval('gentle', 'eof', 1);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/2.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('DELETE', $request->getMethod());
    }

    public function testGetPullRequestDiff()
    {
        $endpoint       = 'repositories/gentle/eof/pullrequests/1/diff';
        $expectedResult = $this->addFakeResponse(array('dummy'));

        /** @var \Bitbucket\API\Repositories\PullRequests $pull */
        $pull   = $this->getApiMock('Bitbucket\API\Repositories\PullRequests');
        $actual = $pull->diff('gentle', 'eof', 1);

        $this->assertEquals($expectedResult, $actual);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/2.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('GET', $request->getMethod());
    }

    public function testGetPullRequestActivity()
    {
        $endpoint       = 'repositories/gentle/eof/pullrequests/1/activity';
        $expectedResult = $this->addFakeResponse(array('dummy'));

        /** @var \Bitbucket\API\Repositories\PullRequests $pull */
        $pull   = $this->getApiMock('Bitbucket\API\Repositories\PullRequests');
        $actual = $pull->activity('gentle', 'eof', 1);

        $this->assertEquals($expectedResult, $actual);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/2.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('GET', $request->getMethod());
    }

    public function testGetRepositoryPullRequestActivity()
    {
        $endpoint       = 'repositories/gentle/eof/pullrequests/activity';
        $expectedResult = $this->addFakeResponse(array('dummy'));

        /** @var \Bitbucket\API\Repositories\PullRequests $pull */
        $pull   = $this->getApiMock('Bitbucket\API\Repositories\PullRequests');
        $actual = $pull->activity('gentle', 'eof');

        $this->assertEquals($expectedResult, $actual);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/2.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('GET', $request->getMethod());
    }

    public function testAcceptAndMergeAPullRequest()
    {
        $endpoint   = 'repositories/gentle/eof/pullrequests/1/merge';
        $params     = array(
            'message'               => 'Lacks documentation.',
            'close_source_branch'   => false
        );

        /** @var \Bitbucket\API\Repositories\PullRequests $pull */
        $pull   = $this->getApiMock('Bitbucket\API\Repositories\PullRequests');

        $pull->accept('gentle', 'eof', 1, $params);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/2.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('POST', $request->getMethod());
        $this->assertSame(json_encode($params), $request->getBody()->getContents());
    }

    public function testDeclineAPullRequest()
    {
        $endpoint   = 'repositories/gentle/eof/pullrequests/1/decline';
        $params     = array(
            'message' => 'Please update the test suite.',
        );

        /** @var \Bitbucket\API\Repositories\PullRequests $pull */
        $pull   = $this->getApiMock('Bitbucket\API\Repositories\PullRequests');

        $pull->decline('gentle', 'eof', 1, $params);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/2.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('POST', $request->getMethod());
        $this->assertSame(json_encode($params), $request->getBody()->getContents());
    }

    /**
     * @ticket 43
     */
    public function testDeclineAPullRequestWithoutAMessage()
    {
        $endpoint   = 'repositories/gentle/eof/pullrequests/1/decline';
        $params     = array(
            'message' => ''
        );

        /** @var \Bitbucket\API\Repositories\PullRequests $pull */
        $pull   = $this->getApiMock('Bitbucket\API\Repositories\PullRequests');

        $pull->decline('gentle', 'eof', 1, array());

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/2.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('POST', $request->getMethod());
        $this->assertSame(json_encode($params), $request->getBody()->getContents());
    }
}
