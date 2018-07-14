<?php

namespace Bitbucket\Tests\API\Users;

use Bitbucket\Tests\API as Tests;
use Bitbucket\API;

class OAuthTest extends Tests\TestCase
{
    public function testGetAllConsumers()
    {
        $endpoint       = 'users/gentle/consumers';
        $expectedResult = $this->addFakeResponse(json_encode('dummy'));

        $oauth = $this->getApiMock('Bitbucket\API\Users\OAuth');

        /** @var $oauth \Bitbucket\API\Users\OAuth */
        $actual = $oauth->all('gentle');

        $this->assertEquals($expectedResult, $actual);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('GET', $request->getMethod());
    }

    public function testCreateNewConsumerSuccess()
    {
        $endpoint       = 'users/gentle/consumers';
        $expectedResult = $this->addFakeResponse(json_encode('dummy'));
        $params         = array(
            'name'          => 'staging',
            'description'   => 'consumer used in staging env',
            'url'           => 'http://stage.example.com/oauth/bitbucket'
        );

        /** @var $oauth \Bitbucket\API\Users\OAuth */
        $oauth = $this->getApiMock('Bitbucket\API\Users\OAuth');
        $actual = $oauth->create('gentle', $params['name'], $params['description'], $params['url']);

        $this->assertEquals($expectedResult, $actual);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('POST', $request->getMethod());
        $this->assertSame(http_build_query($params), $request->getBody()->getContents());
    }

    public function testUpdateConsumerSuccess()
    {
        $endpoint       = 'users/gentle/consumers/22';
        $expectedResult = $this->addFakeResponse(json_encode('dummy'));
        $params         = array(
            'name'          => 'staging',
            'description'   => 'consumer used in staging env',
            'url'           => 'http://stage.example.com/oauth/bitbucket'
        );

        /** @var $oauth \Bitbucket\API\Users\OAuth */
        $oauth = $this->getApiMock('Bitbucket\API\Users\OAuth');
        $actual = $oauth->update('gentle', $params['name'], 22, $params['description'], $params['url']);

        $this->assertEquals($expectedResult, $actual);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('PUT', $request->getMethod());
        $this->assertSame(http_build_query($params), $request->getBody()->getContents());
    }

    public function testDeleteConsumerSuccess()
    {
        $endpoint       = 'users/gentle/consumers/22';
        $expectedResult = $this->addFakeResponse(json_encode('dummy'));

        /** @var $oauth \Bitbucket\API\Users\OAuth */
        $oauth = $this->getApiMock('Bitbucket\API\Users\OAuth');
        $actual = $oauth->delete('gentle', 22);

        $this->assertEquals($expectedResult, $actual);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('DELETE', $request->getMethod());
    }
}
