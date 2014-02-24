<?php

namespace Bitbucket\Tests\API\Http;

use Bitbucket\Tests\API as Tests;
use Bitbucket\API\Http\Client;
use Buzz\Client\Curl;

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
        $this->client = new Client(array(), new Curl());
    }

    public function testGetSelfInstance()
    {
        $this->assertInstanceOf('\Buzz\Client\Curl', $this->client->getClient());
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
     * @expectedException \InvalidArgumentException
     */
    public function testSetApiVersionInvalid()
    {
        $this->client->setApiVersion('1.1.1');
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
        $baseClient = $this->getBrowserMock();
        $client     = new Client(array(
                'base_url'      => '',
                'api_version'   => ''
            ),
            $baseClient
        );
        $response   = $client->get($endpoint, $params, $headers);

        $this->assertInstanceOf('\Buzz\Message\MessageInterface', $response);
        $this->assertInstanceOf('\Buzz\Message\MessageInterface', $client->getLastResponse());
    }

    public function testShouldDoPostRequestWithContentAndReturnResponseInstance()
    {
        $endpoint   = 'repositories/gentle/eof/issues/3';
        $params     = array('1' => '2');
        $headers    = array('3' => '4');
        $baseClient = $this->getBrowserMock();
        $client     = new Client(array('user_agent' => 'tests'), $baseClient);
        $response   = $client->post($endpoint, $params, $headers);

        $this->assertInstanceOf('\Buzz\Message\MessageInterface', $response);
        $this->assertEquals('1=2', $client->getLastRequest()->getContent());
        $this->assertEquals( array('User-Agent: tests', '4'), $client->getLastRequest()->getHeaders() );
    }

    public function testShouldDoPutRequestAndReturnResponseInstance()
    {
        $endpoint   = 'repositories/gentle/eof/issues/3';
        $params     = array('1' => '2');
        $headers    = array('3' => '4');
        $baseClient = $this->getBrowserMock();
        $client     = new Client(array(), $baseClient);
        $response   = $client->put($endpoint, $params, $headers);

        $this->assertInstanceOf('\Buzz\Message\MessageInterface', $response);
    }

    public function testShouldDoDeleteRequestAndReturnResponseInstance()
    {
        $endpoint   = 'repositories/gentle/eof/issues/3';
        $params     = array('1' => '2');
        $headers    = array('3' => '4');
        $baseClient = $this->getBrowserMock();
        $client     = new Client(array(), $baseClient);
        $response   = $client->delete($endpoint, $params, $headers);

        $this->assertInstanceOf('\Buzz\Message\MessageInterface', $response);
    }

    public function testShouldDoPatchRequestAndReturnResponseInstance()
    {
        $endpoint   = 'repositories/gentle/eof/issues/3';
        $params     = array('1' => '2');
        $headers    = array('3' => '4');
        $baseClient = $this->getBrowserMock();
        $client     = new Client(array(), $baseClient);
        $response   = $client->request($endpoint, $params, 'PATCH', $headers);

        $this->assertInstanceOf('\Buzz\Message\MessageInterface', $response);
    }
} 
