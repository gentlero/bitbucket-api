<?php

namespace Bitbucket\Tests\API;

use Bitbucket\API\Http\HttpPluginClientBuilder;
use Http\Mock\Client;
use Psr\Http\Message\ResponseInterface;

abstract class TestCase extends \PHPUnit\Framework\TestCase
{
    /** @var Client */
    protected $mockClient;

    protected function getApiMock($class = null)
    {
        $class = is_null($class) ? '\Bitbucket\API\Api' : $class;

        return new $class([], new \Bitbucket\API\Http\Client(array(), $this->getHttpPluginClientBuilder()));
    }

    private function getMockHttpClient()
    {
        return $this->mockClient ? : $this->mockClient = new Client();
    }

    protected function getHttpPluginClientBuilder()
    {
        return new HttpPluginClientBuilder($this->getMockHttpClient());
    }

    protected function addFakeResponse($data, $statusCode = 200)
    {
        $content = $this->getMockBuilder('Psr\Http\Message\StreamInterface')->disableOriginalConstructor()->getMock();
        /** @var ResponseInterface $response */
        $response = $this->getMockBuilder('Psr\Http\Message\ResponseInterface')->getMock();

        $response
            ->expects($this->any())
            ->method('getBody')
            ->will($this->returnValue($content));

        $response
            ->expects($this->any())
            ->method('getStatusCode')
            ->will($this->returnValue($statusCode));

        $response
            ->expects($this->any())
            ->method('getProtocolVersion')
            ->will($this->returnValue('1.1'));

        $response
            ->expects($this->any())
            ->method('getHeaders')
            ->will($this->returnValue([]));

        $content
            ->expects($this->any())
            ->method('getContents')
            ->will($this->returnValue($data));

        $this->getMockHttpClient()->addResponse($response);

        return $response;
    }

    protected function getMethod($class, $name)
    {
        $class = new \ReflectionClass($class);
        $method = $class->getMethod($name);
        $method->setAccessible(true);
        return $method;
    }
}
