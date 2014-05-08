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
        $expectedResult = json_encode('dummy');

        $pullRequests = $this->getApiMock('Bitbucket\API\Repositories\PullRequests');
        $pullRequests->expects($this->once())
            ->method('requestGet')
            ->with($endpoint)
            ->will($this->returnValue($expectedResult));

        /** @var $pullRequests \Bitbucket\API\Repositories\PullRequests */
        $actual = $pullRequests->all('gentle', 'eof');

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
}
