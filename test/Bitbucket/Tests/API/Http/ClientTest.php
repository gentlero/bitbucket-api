<?php

namespace Bitbucket\Tests\API\Http;

use Bitbucket\API\Http\Listener\NormalizeArrayListener;
use Bitbucket\API\Http\Listener\OAuthListener;
use Bitbucket\Tests\API as Tests;
use Bitbucket\API\Http\Client;

/**
 * @author  Alexandru G.    <alex@gentle.ro>
 */
class ClientTest extends Tests\TestCase
{
    /**
     * @var Client
     */
    private $client;

    public function setUp()
    {
        $this->client = new Client(array(), $this->getHttpPluginClientBuilder());
    }

    public function testGetSelfInstance()
    {
        $this->assertInstanceOf('Http\Client\Common\HttpMethodsClient', $this->client->getClient());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testSetResponseFormatInvalid()
    {
        $this->client->setResponseFormat('invalid');
    }

    public function testResponseFormatSuccess()
    {
        $this->client->setResponseFormat('xml');
        $this->assertEquals('xml', $this->client->getResponseFormat());
    }

    /**
     * @dataProvider invalidApiVersionsProvider
     * @expectedException \InvalidArgumentException
     * @ticket 57
     */
    public function testSetApiVersionInvalid($version)
    {
        $this->client->setApiVersion($version);
    }

    public function testApiVersionSuccess()
    {
        $this->client->setApiVersion('2.0');
        $this->assertEquals('2.0', $this->client->getApiVersion());
    }

    public function testGetApiBaseUrl()
    {
        $this->assertEquals('https://api.bitbucket.org/1.0', $this->client->getApiBaseUrl());

        $this->client->setApiVersion('2.0');
        $this->assertEquals('https://api.bitbucket.org/2.0', $this->client->getApiBaseUrl());
    }

    public function testShouldDoGetRequestAndReturnResponseInstance()
    {
        $endpoint   = 'repositories/gentle/eof/issues/3';
        $params     = array('format' => 'json');
        $headers    = array('2' => '4');
        $baseClient = $this->getHttpPluginClientBuilder();
        $client     = new Client(
            array(
                'base_url'      => 'https://example.com',
                'api_version'   => '1.0'
            ),
            $baseClient
        );
        $response   = $client->get($endpoint, $params, $headers);

        $this->assertInstanceOf('Psr\Http\Message\MessageInterface', $response);
        $this->assertInstanceOf('Psr\Http\Message\MessageInterface', $client->getLastResponse());
    }

    public function testShouldDoPostRequestWithContentAndReturnResponseInstance()
    {
        $endpoint   = 'repositories/gentle/eof/issues/3';
        $params     = array('1' => '2');
        $headers    = array('3' => '4');
        $baseClient = $this->getHttpPluginClientBuilder();
        $client     = new Client(array('user_agent' => 'tests'), $baseClient);
        $response   = $client->post($endpoint, $params, $headers);

        $this->assertInstanceOf('Psr\Http\Message\MessageInterface', $response);
        $this->assertEquals('1=2', $client->getLastRequest()->getBody()->getContents());
        $this->assertEquals(
            array('Content-Type' => 'application/x-www-form-urlencoded', 'User-Agent' => 'tests', '4'),
            $client->getLastRequest()->getHeaders()
        );
    }

    /**
     * @ticket 74
     */
    public function testShouldDoPostRequestWithJsonContentAndReturnResponseInstance()
    {
        $endpoint   = 'repositories/gentle/eof/pullrequests';
        $params     = json_encode(array('1' => '2', 'name' => 'john'));
        $headers    = array('Content-Type' => 'application/json');
        $baseClient = $this->getHttpPluginClientBuilder();
        $client     = new Client(array('user_agent' => 'tests'), $baseClient);
        $response   = $client->post($endpoint, $params, $headers);

        $this->assertInstanceOf('Psr\Http\Message\MessageInterface', $response);
        $this->assertEquals($params, $client->getLastRequest()->getBody()->getContents());
        $this->assertEquals(
            array('User-Agent' => 'tests', 'Content-Type' => ['application/json']),
            $client->getLastRequest()->getHeaders()
        );
    }

    public function testShouldDoPutRequestAndReturnResponseInstance()
    {
        $endpoint   = 'repositories/gentle/eof/issues/3';
        $params     = array('1' => '2');
        $headers    = array('3' => '4');
        $baseClient = $this->getHttpPluginClientBuilder();
        $client     = new Client(array(), $baseClient);
        $response   = $client->put($endpoint, $params, $headers);

        $this->assertInstanceOf('\Psr\Http\Message\MessageInterface', $response);
    }

    public function testShouldDoDeleteRequestAndReturnResponseInstance()
    {
        $endpoint   = 'repositories/gentle/eof/issues/3';
        $params     = array('1' => '2');
        $headers    = array('3' => '4');
        $baseClient = $this->getHttpPluginClientBuilder();
        $client     = new Client(array(), $baseClient);
        $response   = $client->delete($endpoint, $params, $headers);

        $this->assertInstanceOf('\Psr\Http\Message\MessageInterface', $response);
    }

    public function testShouldDoPatchRequestAndReturnResponseInstance()
    {
        $endpoint   = 'repositories/gentle/eof/issues/3';
        $params     = array('1' => '2');
        $headers    = array('3' => '4');
        $baseClient = $this->getHttpPluginClientBuilder();
        $client     = new Client(array(), $baseClient);
        $response   = $client->request($endpoint, $params, 'PATCH', $headers);

        $this->assertInstanceOf('\Psr\Http\Message\MessageInterface', $response);
    }

    public function testClientIsKeptWhenInvokingChildFactory()
    {
        $options = array(
            'base_url' => 'https://localhost'
        );
        $client = new Client($options);
        $pullRequest = new \Bitbucket\API\Repositories\PullRequests();
        $pullRequest->setClient($client);
        $comments = $pullRequest->comments();
        $this->assertSame($client, $comments->getClient());
    }

    public function testCurrentApiVersion()
    {
        $client = new \Bitbucket\API\Http\Client();
        $client->setApiVersion('1.0');
        $this->assertFalse($client->isApiVersion('2.0'));
        $client->setApiVersion('2.0');
        $this->assertFalse($client->isApiVersion('1'));
        $this->assertTrue($client->isApiVersion('2.0'));
        $this->assertTrue($client->isApiVersion('2'));
    }

    /**
     * @ticket 64
     */
    public function testIncludeFormatParamOnlyInV1()
    {
        $endpoint = sprintf(
            'repositories/gentlero/bitbucket-api/src/%s/%s',
            'develop',
            'lib/Bitbucket/API/Repositories'
        );
        $params = $headers = [];

        $baseClient = $this->getHttpPluginClientBuilder();
        $client     = new Client(['api_version' => '2.0'], $baseClient);
        $client->get($endpoint, $params, $headers);

        /** @noinspection PhpUndefinedMethodInspection */
        $req    = $client->getLastRequest()->getUri();
        $parts  = parse_url($req);

        if (false === array_key_exists('query', $parts)) {
            $parts['query'] = '';
        }

        $this->assertFalse(strpos($parts['query'], 'format'));
    }

    private function getListenerMock($name = 'dummy')
    {
        $listener = $this->getMock('Bitbucket\API\Http\Listener\ListenerInterface');

        $listener->expects($this->any())->method('getName')->will($this->returnValue($name));

        return $listener;
    }

    public function invalidApiVersionsProvider()
    {
        return [
            ['3.1'], ['1,2'], ['1,0'], ['2.1'], ['4'], [2], ['string'], [2.0]
        ];
    }
}
