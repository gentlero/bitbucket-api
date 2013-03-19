<?php

namespace Gentle\Bitbucket\Tests\API\Repo;

use Gentle\Bitbucket\Tests\API as Tests;
use Gentle\Bitbucket\API;

class IssueTest extends Tests\TestCase
{
    public function testGetIssuesWithAdditionalParams()
    {
        $endpoint       = 'repositories/gentle/eof/issues';
        $expectedResult = file_get_contents(__DIR__.'/../data/issue/multiple.json');
        $params         = array(
            'format'    => 'json',
            'limit'     => 5,
            'start'     => 0
        );

        $issue = $this->getApiMock('Gentle\Bitbucket\API\Repo\Issue');
        $issue->expects($this->once())
            ->method('requestGet')
            ->with($endpoint, $params)
            ->will( $this->returnValue($expectedResult) );

        /** @var $issue \Gentle\Bitbucket\API\Repo\Issue */
        $actual = $issue->all('gentle', 'eof', $params);

        $this->assertEquals($expectedResult, $actual);
    }

    public function testGet()
    {
        $endpoint       = 'repositories/gentle/eof/issues/3';
        $expectedResult = file_get_contents(__DIR__.'/../data/issue/single.json');
        $params         = array();

        $issue = $this->getApiMock('Gentle\Bitbucket\API\Repo\Issue');
        $issue->expects($this->once())
            ->method('requestGet')
            ->with($endpoint, $params)
            ->will( $this->returnValue($expectedResult) );

        /** @var $issue \Gentle\Bitbucket\API\Repo\Issue */
        $actual = $issue->get('gentle', 'eof', 3);

        $this->assertEquals($expectedResult, $actual);
    }

    public function testGetIssueFollowers()
    {
        $endpoint       = 'repositories/gentle/eof/issues/3/followers';
        $expectedResult = file_get_contents(__DIR__.'/../data/issue/followers.json');
        $params         = array();

        $issue = $this->getApiMock('Gentle\Bitbucket\API\Repo\Issue');
        $issue->expects($this->once())
            ->method('requestGet')
            ->with($endpoint, $params)
            ->will( $this->returnValue($expectedResult) );

        /** @var $issue \Gentle\Bitbucket\API\Repo\Issue */
        $actual = $issue->followers('gentle', 'eof', 3);

        $this->assertEquals($expectedResult, $actual);
    }

    public function testCreateIssue()
    {
        $endpoint       = 'repositories/gentle/eof/issues';
        $params         = array(
            'format'    => 'json',
            'title'     => 'dummy title',
            'content'   => 'dummy content'
        );

        $issue = $this->getApiMock('Gentle\Bitbucket\API\Repo\Issue');
        $issue->expects($this->once())
            ->method('requestPost')
            ->with($endpoint, $params);

        /** @var $issue \Gentle\Bitbucket\API\Repo\Issue */
        $issue->create('gentle', 'eof', $params);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testShouldNotCreateIssueWithoutTitle()
    {
        $params         = array(
            'format'    => 'json',
            'content'   => 'dummy content'
        );

        $issue = $this->getApiMock('Gentle\Bitbucket\API\Repo\Issue');
        $issue->expects($this->never())
            ->method('requestPost');

        /** @var $issue \Gentle\Bitbucket\API\Repo\Issue */
        $issue->create('gentle', 'eof', $params);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testShouldNotCreateIssueWithoutContent()
    {
        $params         = array(
            'format'    => 'json',
            'title'     => 'dummy title'
        );

        $issue = $this->getApiMock('Gentle\Bitbucket\API\Repo\Issue');
        $issue->expects($this->never())
            ->method('requestPost');

        /** @var $issue \Gentle\Bitbucket\API\Repo\Issue */
        $issue->create('gentle', 'eof', $params);
    }

    public function testUpdateIssue()
    {
        $endpoint       = 'repositories/gentle/eof/issues/3';
        $params         = array(
            'format'    => 'json',
            'title'     => 'dummy title',
            'content'   => 'dummy content'
        );

        $issue = $this->getApiMock('Gentle\Bitbucket\API\Repo\Issue');
        $issue->expects($this->once())
            ->method('requestPut')
            ->with($endpoint, $params);

        /** @var $issue \Gentle\Bitbucket\API\Repo\Issue */
        $issue->update('gentle', 'eof', 3, $params);
    }


    public function testDeleteIssue()
    {
        $endpoint       = 'repositories/gentle/eof/issues/2';
        $expectedResult = array('dummyOutput');

        $issue = $this->getApiMock('Gentle\Bitbucket\API\Repo\Issue');
        $issue->expects($this->once())
            ->method('requestDelete')
            ->with($endpoint)
            ->will($this->returnValue($expectedResult));

        /** @var $issue \Gentle\Bitbucket\API\Repo\Issue */
        $actual = $issue->delete('gentle', 'eof', 2);

        $this->assertEquals($expectedResult, $actual);
    }
}
