<?php

namespace Bitbucket\Tests\API;

use Buzz\Message\Response;

abstract class TestCase extends \PHPUnit_Framework_TestCase
{
    protected function getApiMock($class = null, $methods = array())
    {
        $class      = is_null($class) ? '\Bitbucket\API\Api' : $class;
        $methods    = array_merge(
            array('requestGet', 'requestPost', 'requestPut', 'requestDelete'),
            $methods
        );

        $client = $this->getMock(
            '\Buzz\Client\ClientInterface',
            array('setTimeout', 'setVerifyPeer', 'send')
        );

        $client->expects($this->any())
            ->method('setTimeout')
            ->with(10);
        $client->expects($this->any())
            ->method('setVerifyPeer')
            ->with(false);
        $client->expects($this->any())
            ->method('send');

        return $this->getMockBuilder($class)
            ->setMethods($methods)
            ->setConstructorArgs(array($client))
            ->getMock();
    }

    protected function getBrowserMock()
    {
        return $this->getMock('Buzz\Client\ClientInterface', array('setTimeout', 'setVerifyPeer', 'send'));
    }

    protected function getTransportClientMock()
    {
        $client = $this->getBrowserMock();

        $client->expects($this->any())->method('setTimeout')->with(10);
        $client->expects($this->any())->method('setVerifyPeer')->with(false);
        $client->expects($this->any())->method('send');

        return $client;
    }

    protected function getHttpClientMock()
    {
        $transportClient = $this->getTransportClientMock();

        return $this->getMockBuilder('Bitbucket\API\HTTP\Client')
            ->setMethods(array('get', 'post', 'put', 'delete'))
            ->setConstructorArgs(array(array(), $transportClient))
            ->getMock();
    }

    protected function fakeResponse($data)
    {
        $response = new Response();

        $response->setContent(json_encode($data));

        return $response;
    }

    protected function getClassMock($class, $httpClient)
    {
        $obj = new $class($this->getTransportClientMock());
        $obj->setClient($httpClient);

        return $obj;
    }

    protected function getMethod($class, $name)
    {
        $class = new \ReflectionClass($class);
        $method = $class->getMethod($name);
        $method->setAccessible(true);
        return $method;
    }
}
