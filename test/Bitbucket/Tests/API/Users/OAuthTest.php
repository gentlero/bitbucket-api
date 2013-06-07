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
}