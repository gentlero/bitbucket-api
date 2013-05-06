<?php

namespace Bitbucket\Tests\API;

abstract class TestCase extends \PHPUnit_Framework_TestCase
{
    protected function getApiMock($class = null, $methods = array())
    {
        $class      = is_null($class) ? '\Bitbucket\API\Api' : $class;
        $methods    = array_merge(
            array('requestGet', 'requestPost', 'requestPut', 'requestDelete'), $methods
        );

        $client = $this->getMock('\Buzz\Client\ClientInterface', 
            array('setTimeout', 'setVerifyPeer', 'send'));

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

    protected function getMethod($class, $name) {
        $class = new \ReflectionClass($class);
        $method = $class->getMethod($name);
        $method->setAccessible(true);
        return $method;
    }
}
