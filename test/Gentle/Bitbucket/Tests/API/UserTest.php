<?php

namespace Gentle\Bitbucket\Tests\API\Repo;

use Gentle\Bitbucket\Tests\API as Tests;
use Gentle\Bitbucket\API;

class UserTest extends Tests\TestCase
{
    public function testGetUserProfileSuccess()
    {
        $endpoint       = 'user/';
        $expectedResult = json_encode('dummy');

        $user = $this->getApiMock('\Gentle\Bitbucket\API\User');
        $user->expects($this->once())
            ->method('requestGet')
            ->with($endpoint)
            ->will( $this->returnValue($expectedResult));

        /** @var $user \Gentle\Bitbucket\API\User */
        $actual = $user->get();

        $this->assertEquals($expectedResult, $actual);
    }
}