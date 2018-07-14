<?php

namespace Bitbucket\Tests\API\Repositories;

use Bitbucket\Tests\API as Tests;
use Bitbucket\API;

class IssueTest extends Tests\TestCase
{
    public function testGetIssuesWithAdditionalParams()
    {
        $endpoint       = 'repositories/gentle/eof/issues';
        $expectedResult = $this->addFakeResponse(file_get_contents(__DIR__.'/../data/issue/multiple.json'));
        $params         = array(
            'format'    => 'json',
            'limit'     => 5,
            'start'     => 0
        );

        /** @var $issue \Bitbucket\API\Repositories\Issues */
        $issue = $this->getApiMock('Bitbucket\API\Repositories\Issues');

        $actual = $issue->all('gentle', 'eof', $params);

        $this->assertEquals($expectedResult, $actual);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('format=json&limit=5&start=0', $request->getUri()->getQuery());
        $this->assertSame('GET', $request->getMethod());
    }

    public function testGet()
    {
        $endpoint       = 'repositories/gentle/eof/issues/3';
        $expectedResult = $this->addFakeResponse(file_get_contents(__DIR__.'/../data/issue/single.json'));

        /** @var $issue \Bitbucket\API\Repositories\Issues */
        $issue = $this->getApiMock('Bitbucket\API\Repositories\Issues');


        $actual = $issue->get('gentle', 'eof', 3);

        $this->assertEquals($expectedResult, $actual);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('GET', $request->getMethod());
    }

    public function testGetIssueFollowers()
    {
        $endpoint       = 'repositories/gentle/eof/issues/3/followers';
        $expectedResult = $this->addFakeResponse(file_get_contents(__DIR__.'/../data/issue/followers.json'));

        /** @var $issue \Bitbucket\API\Repositories\Issues */
        $issue = $this->getApiMock('Bitbucket\API\Repositories\Issues');

        $actual = $issue->followers('gentle', 'eof', 3);

        $this->assertEquals($expectedResult, $actual);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('GET', $request->getMethod());
    }

    public function testCreateIssue()
    {
        $endpoint       = 'repositories/gentle/eof/issues';
        $params         = array(
            'format'    => 'json',
            'title'     => 'dummy title',
            'content'   => 'dummy content'
        );

        /** @var $issue \Bitbucket\API\Repositories\Issues */
        $issue = $this->getApiMock('Bitbucket\API\Repositories\Issues');

        $issue->create('gentle', 'eof', $params);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('POST', $request->getMethod());
        $this->assertSame('format=json&title=dummy+title&content=dummy+content', $request->getBody()->getContents());
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

        /** @var $issue \Bitbucket\API\Repositories\Issues */
        $issue = $this->getApiMock('Bitbucket\API\Repositories\Issues');

        $issue->create('gentle', 'eof', $params);

        $this->assertNull($this->mockClient->getLastRequest());
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

        /** @var $issue \Bitbucket\API\Repositories\Issues */
        $issue = $this->getApiMock('Bitbucket\API\Repositories\Issues');

        $issue->create('gentle', 'eof', $params);

        $this->assertNull($this->mockClient->getLastRequest());
    }

    public function testUpdateIssue()
    {
        $endpoint       = 'repositories/gentle/eof/issues/3';
        $params         = array(
            'format'    => 'json',
            'title'     => 'dummy title',
            'content'   => 'dummy content'
        );

        /** @var $issue \Bitbucket\API\Repositories\Issues */
        $issue = $this->getApiMock('Bitbucket\API\Repositories\Issues');

        $issue->update('gentle', 'eof', 3, $params);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('PUT', $request->getMethod());
        $this->assertSame('format=json&title=dummy+title&content=dummy+content', $request->getBody()->getContents());
    }


    public function testDeleteIssue()
    {
        $endpoint       = 'repositories/gentle/eof/issues/2';
        $expectedResult = $this->addFakeResponse(array('dummyOutput'));

        /** @var $issue \Bitbucket\API\Repositories\Issues */
        $issue = $this->getApiMock('Bitbucket\API\Repositories\Issues');

        $actual = $issue->delete('gentle', 'eof', 2);

        $this->assertEquals($expectedResult, $actual);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('DELETE', $request->getMethod());
    }
}
