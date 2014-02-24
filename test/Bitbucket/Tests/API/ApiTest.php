<?php

namespace Bitbucket\Tests\API;

use Bitbucket\API;

class ApiTest extends TestCase
{
    public function testCredentials()
    {
        $auth = new API\Authentication\Basic('api_username', 'api_password');
        $this->assertInstanceOf('Bitbucket\API\Authentication\Basic', $auth);

        $api = new API\Api;
        $api->setCredentials($auth);
    }

    public function testShouldDoGetRequest()
    {
        $endpoint       = 'repositories/gentle/eof/issues/3';
        $params         = array();
        $headers        = array();
        
        $client     = $this->getBrowserMock();
        $api        = new API\Api($client);
        
        $api->requestGet($endpoint, $params, $headers);
    }

    public function testShouldDoPostRequest()
    {
        $endpoint       = 'repositories/gentle/eof/issues/3';
        $params         = array();
        $headers        = array();
        
        $client     = $this->getBrowserMock();
        $api        = new API\Api($client);
        
        $api->requestPost($endpoint, $params, $headers);
    }

    public function testShouldDoPutRequest()
    {
        $endpoint       = 'repositories/gentle/eof/issues/3';
        $params         = array();
        $headers        = array();
        
        $client     = $this->getBrowserMock();
        $api        = new API\Api($client);
        
        $api->requestPut($endpoint, $params, $headers);
    }

    public function testShouldDoDeleteRequest()
    {
        $endpoint       = 'repositories/gentle/eof/issues/3';
        $params         = array();
        $headers        = array();

        $client     = $this->getBrowserMock();
        $api        = new API\Api($client);

        $api->requestDelete($endpoint, $params, $headers);
    }

    public function testProcessResponseContent()
    {
        $expectedResult = file_get_contents(__DIR__.'/data/issue/single.json');

        $actual = $this->processResponse('HTTP/1.1 200 OK', $expectedResult);

        $this->assertEquals($expectedResult, $actual);
    }

    public function testProcessResponseNoContent()
    {
        $expectedResult = true;
        
        $actual = $this->processResponse('HTTP/1.1 204 No Content', $expectedResult);

        $this->assertEquals($expectedResult, $actual);
    }

    public function testProcessResponseBadRequest()
    {
        $response = new \Buzz\Message\Response;
        $response->addHeader('HTTP/1.1 400 Bad Request');
        $expectedResult = $response;
        
        $method = $this->getMethod('Bitbucket\API\Api', 'processResponse');
        $obj    = new API\Api;
        $actual = $method->invokeArgs($obj, array($response));

        $this->assertEquals($expectedResult, $actual);
    }

    /**
     * @expectedException \Bitbucket\API\Authentication\Exception
     */
    public function testProcessResponseUnauthorized()
    {
        $this->processResponse('HTTP/1.1 401 Unauthorized');
    }

    /**
     * @expectedException \Bitbucket\API\Exceptions\ForbiddenAccessException
     */
    public function testProcessResponseForbidden()
    {
        $this->processResponse('HTTP/1.1 403 Forbidden');
    }

    public function testProcessResponseNotFound()
    {
        $expectedResult = false;
        
        $actual = $this->processResponse('HTTP/1.1 404 Not Found', $expectedResult);

        $this->assertEquals($expectedResult, $actual);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testFormat()
    {
        $api = new API\Api;

        // default format
        $this->assertEquals('json', $api->getFormat());

        // set new format
        $api->setFormat('xml');
        $this->assertEquals('xml', $api->getFormat());

        // invalid format
        $api->setFormat('invalid format');
    }

    protected function processResponse($header, $expectedResult = null)
    {
        $response = new \Buzz\Message\Response;
        $response->setContent($expectedResult);
        $response->addHeader($header);        

        $method = $this->getMethod('Bitbucket\API\Api', 'processResponse');
        $obj = new API\Api;
        
        return $method->invokeArgs($obj, array($response));
    }
}
