<?php

namespace Bitbucket\Tests\API;

use Bitbucket\API;
use Http\Message\Authentication\BasicAuth;

class ApiTest extends TestCase
{
    public function testCredentials()
    {
        $api = new API\Api;
        $api->setCredentials(new BasicAuth('api_username', 'api_password'));
    }

    public function testShouldDoGetRequest()
    {
        $endpoint       = 'repositories/gentle/eof/issues/3';
        $params         = array();
        $headers        = array();
        $api            = $this->getApiMock("Bitbucket\API\Api");

        $api->requestGet($endpoint, $params, $headers);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/' . $api->getClient()->getApiVersion() . '/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('GET', $request->getMethod());
    }

    public function testShouldDoPostRequest()
    {
        $endpoint       = 'repositories/gentle/eof/issues/3';
        $params         = array('key' => 'value');
        $headers        = array();
        $api            = $this->getApiMock("Bitbucket\API\Api");

        $api->requestPost($endpoint, $params, $headers);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/' . $api->getClient()->getApiVersion() . '/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('POST', $request->getMethod());
        $this->assertSame('key=value', $request->getBody()->getContents());
    }

    public function testShouldDoPutRequest()
    {
        $endpoint       = 'repositories/gentle/eof/issues/3';
        $params         = array('key' => 'value');
        $headers        = array();
        $api            = $this->getApiMock("Bitbucket\API\Api");

        $api->requestPut($endpoint, $params, $headers);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/' . $api->getClient()->getApiVersion() . '/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('PUT', $request->getMethod());
        $this->assertSame('key=value', $request->getBody()->getContents());
    }

    public function testShouldDoDeleteRequest()
    {
        $endpoint       = 'repositories/gentle/eof/issues/3';
        $params         = array();
        $headers        = array();
        /** @var Api\Api $api */
        $api            = $this->getApiMock("Bitbucket\API\Api");

        $api->requestDelete($endpoint, $params, $headers);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/' . $api->getClient()->getApiVersion() . '/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('DELETE', $request->getMethod());
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

    /**
     * @dataProvider invalidChildNameProvider
     * @expectedException \InvalidArgumentException
     */
    public function testSPFShouldFailWithInvalidClassName($name)
    {
        $bitbucket = new API\Api();
        $bitbucket->api($name);
    }

    public function testDifferentHttpClientInstanceOnCloning()
    {
        $repo1 = new \Bitbucket\API\Repositories();
        $repo2 = clone $repo1;
        $repo1->setFormat('xml');

        $this->assertEquals('xml', $repo1->getFormat());
        $this->assertNotEquals('xml', $repo2->getFormat());
        $this->assertNotSame($repo1, $repo2);
    }

    public function invalidChildNameProvider()
    {
        return [
            [array()], [new \stdClass()], [21], ['32.4'], ['invalid']
        ];
    }
}
