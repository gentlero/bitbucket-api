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
        $api            = new API\Api(array(), $this->getHttpClientMock());

        $api->requestGet($endpoint, $params, $headers);
    }

    public function testShouldDoPostRequest()
    {
        $endpoint       = 'repositories/gentle/eof/issues/3';
        $params         = array();
        $headers        = array();
        $api            = new API\Api(array(), $this->getHttpClientMock());

        $api->requestPost($endpoint, $params, $headers);
    }

    public function testShouldDoPutRequest()
    {
        $endpoint       = 'repositories/gentle/eof/issues/3';
        $params         = array();
        $headers        = array();
        $api            = new API\Api(array(), $this->getHttpClientMock());

        $api->requestPut($endpoint, $params, $headers);
    }

    public function testShouldDoDeleteRequest()
    {
        $endpoint       = 'repositories/gentle/eof/issues/3';
        $params         = array();
        $headers        = array();
        $api            = new API\Api(array(), $this->getHttpClientMock());

        $api->requestDelete($endpoint, $params, $headers);
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
