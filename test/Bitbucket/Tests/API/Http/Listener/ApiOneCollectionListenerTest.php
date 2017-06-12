<?php

namespace Bitbucket\Tests\API\Http\Listener;

use Bitbucket\Tests\API as Tests;
use Bitbucket\API\Http\Listener\ApiOneCollectionListener;
use Buzz\Message\Request;
use Buzz\Message\Response;

/**
 * @author Alexandru Guzinschi <alex@gentle.ro>
 */
class ApiOneCollectionListenerTest extends Tests\TestCase
{
    public function testMetadataExistsForApiv1()
    {
        $listener   = new ApiOneCollectionListener();
        $request    = new Request('GET', '/1.0/repositories/team/repo/issues?limit=2&start=2', 'http://localhost');
        $response   = new Response();
        $content    = [
            'count'     => 5,
            'issues'    => [
                'issue_3' => [],
                'issue_4' => []
            ]
        ];
        $response->setContent(json_encode($content));

        $listener->postSend($request, $response);

        $this->assertInstanceOf('\Buzz\Message\Response', $response);
        $body = json_decode($response->getContent(), true);

        $this->assertEquals('api_one_collection', $listener->getName());
        $this->assertEquals($content['issues'], $body['issues']);

        $this->assertArrayHasKey('values', $body);
        $this->assertEquals($body['values'], '.issues');

        $this->assertArrayHasKey('next', $body);
        $this->assertEquals('http://localhost/1.0/repositories/team/repo/issues?limit=2&start=4', $body['next']);
        $this->assertArrayHasKey('previous', $body);
        $this->assertEquals('http://localhost/1.0/repositories/team/repo/issues?limit=2&start=0', $body['previous']);
    }

    public function testNonExistentPageReturnsLastPage()
    {
        $listener   = new ApiOneCollectionListener();
        $request    = new Request('GET', '/1.0/repositories/team/repo/issues?limit=2&start=6', 'http://localhost');
        $response   = new Response();
        $content    = [
            'count'     => 5,
            'issues'    => [
                'issue_5' => []
            ]
        ];
        $response->setContent(json_encode($content));

        $listener->postSend($request, $response);

        $this->assertInstanceOf('\Buzz\Message\Response', $response);
        $body = json_decode($response->getContent(), true);

        $this->assertEquals($content['issues'], $body['issues']);

        $this->assertArrayHasKey('values', $body);
        $this->assertEquals($body['values'], '.issues');

        $this->assertArrayNotHasKey('next', $body);
        $this->assertArrayHasKey('previous', $body);
        $this->assertEquals('http://localhost/1.0/repositories/team/repo/issues?limit=2&start=4', $body['previous']);
    }

    public function testInvalidJsonResponseShouldResultInANullBodyContent()
    {
        $listener   = new ApiOneCollectionListener();
        $request    = new Request('GET', '/1.0/repositories/team/repo/issues?limit=2&start=2', 'http://localhost');
        $response   = new Response();
        $response->setContent('{"key": "value}');

        $listener->postSend($request, $response);

        $this->assertInstanceOf('\Buzz\Message\Response', $response);
        $body = json_decode($response->getContent(), true);

        $this->assertNull($body);
    }

    public function testResponseWithoutCollection()
    {
        $listener   = new ApiOneCollectionListener();
        $request    = new Request('GET', '/1.0/repositories/team/repo/issues', 'http://localhost');
        $response   = new Response();
        $content    = [
            'issues'    => [
                'issue_3' => [],
                'issue_4' => []
            ]
        ];
        $response->setContent(json_encode($content));

        $listener->postSend($request, $response);

        $this->assertInstanceOf('\Buzz\Message\Response', $response);
        $body = json_decode($response->getContent(), true);

        $this->assertEquals($content['issues'], $body['issues']);

        $this->assertArrayNotHasKey('values', $body);
        $this->assertArrayNotHasKey('count', $body);
        $this->assertArrayNotHasKey('next', $body);
        $this->assertArrayNotHasKey('previous', $body);
    }
}
