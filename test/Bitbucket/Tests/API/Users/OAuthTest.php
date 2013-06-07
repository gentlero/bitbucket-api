<?php

namespace Bitbucket\Tests\API\Users;

use Bitbucket\Tests\API as Tests;
use Bitbucket\API;

class OAuthTest extends Tests\TestCase
{
    public function testGetAllConsumers()
    {
        $endpoint       = 'users/gentle/consumers';
        $expectedResult = json_encode('dummy');

        $oauth = $this->getApiMock('Bitbucket\API\Users\OAuth');
        $oauth->expects($this->once())
            ->method('requestGet')
            ->with($endpoint)
            ->will( $this->returnValue($expectedResult) );

        /** @var $oauth \Bitbucket\API\Users\OAuth */
        $actual = $oauth->all('gentle');

        $this->assertEquals($expectedResult, $actual);
    }

    public function testCreateNewConsumerSuccess()
    {
        $endpoint       = 'users/gentle/consumers';
        $expectedResult = json_encode('dummy');
        $params         = array(
            'name'          => 'staging',
            'description'   => 'consumer used in staging env',
            'url'           => 'http://stage.example.com/oauth/bitbucket'
        );

        $oauth = $this->getApiMock('Bitbucket\API\Users\OAuth');
        $oauth->expects($this->once())
            ->method('requestPost')
            ->with($endpoint, $params)
            ->will( $this->returnValue($expectedResult) );

        /** @var $oauth \Bitbucket\API\Users\OAuth */
        $actual = $oauth->create('gentle', $params['name'], $params['description'], $params['url']);

        $this->assertEquals($expectedResult, $actual);
    }

    public function testUpdateConsumerSuccess()
    {
        $endpoint       = 'users/gentle/consumers/22';
        $expectedResult = json_encode('dummy');
        $params         = array(
            'name'          => 'staging',
            'description'   => 'consumer used in staging env',
            'url'           => 'http://stage.example.com/oauth/bitbucket'
        );

        $oauth = $this->getApiMock('Bitbucket\API\Users\OAuth');
        $oauth->expects($this->once())
            ->method('requestPut')
            ->with($endpoint, $params)
            ->will( $this->returnValue($expectedResult) );

        /** @var $oauth \Bitbucket\API\Users\OAuth */
        $actual = $oauth->update('gentle', $params['name'], 22, $params['description'], $params['url']);

        $this->assertEquals($expectedResult, $actual);
    }

    public function testDeleteConsumerSuccess()
    {
        $endpoint       = 'users/gentle/consumers/22';
        $expectedResult = json_encode('dummy');

        $oauth = $this->getApiMock('Bitbucket\API\Users\OAuth');
        $oauth->expects($this->once())
            ->method('requestDelete')
            ->with($endpoint)
            ->will( $this->returnValue($expectedResult) );

        /** @var $oauth \Bitbucket\API\Users\OAuth */
        $actual = $oauth->delete('gentle', 22);

        $this->assertEquals($expectedResult, $actual);
    }
}