<?php

namespace Bitbucket\Tests\API\Http;

use Bitbucket\API\Http\Listener\NormalizeArrayListener;
use Bitbucket\API\Http\Listener\OAuthListener;
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
        $this->assertEquals(
            array('User-Agent: tests', '4', 'Content-Type: application/x-www-form-urlencoded'),
            $client->getLastRequest()->getHeaders()
        );
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

    public function testAddListener()
    {
        $listener = $this->getListenerMock();

        $this->client->addListener($listener, 1);
        $this->client->addListener($listener, 14);

        $this->assertInstanceOf('Bitbucket\API\Http\Listener\ListenerInterface', $this->client->getListener('dummy'));
    }

    public function testDeleteListener()
    {
        $listener = $this->getListenerMock('lorem');

        $this->client->addListener($listener);
        $this->assertTrue($this->client->isListener('lorem'));

        $this->client->delListener($listener);

        $this->assertFalse($this->client->isListener('lorem'));
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testGetAbsentListener()
    {
        $this->client->getListener('invalid');
    }

    public function testSetListenersWorksWithMultipleListeners()
    {
        $listeners = array(
            '0' => array(
                new NormalizeArrayListener(),
                new OAuthListener(array()),
            )
        );

        $this->client->setListeners($listeners);

        $listeners = $this->client->getListeners();

        $this->assertArrayHasKey('normalize_array', $listeners[0]);
        $this->assertArrayHasKey('oauth', $listeners[0]);
    }

    private function getListenerMock($name = 'dummy')
    {
        $listener = $this->getMock('Bitbucket\API\Http\Listener\ListenerInterface');

        $listener->expects($this->any())->method('getName')->will($this->returnValue($name));

        return $listener;
    }
}
