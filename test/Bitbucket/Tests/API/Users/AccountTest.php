<?php

namespace Bitbucket\Tests\API\Users;

use Bitbucket\Tests\API as Tests;
use Bitbucket\API;

class AccountTest extends Tests\TestCase
{
    public function testGetAccountProfile()
    {
        $endpoint       = 'users/gentle';
        $expectedResult = json_encode('dummy');

        $account = $this->getApiMock('Bitbucket\API\Users\Account');
        $account->expects($this->once())
            ->method('requestGet')
            ->with($endpoint)
            ->will( $this->returnValue($expectedResult) );

        /** @var $account \Bitbucket\API\Users\Account */
        $actual = $account->profile('gentle');

        $this->assertEquals($expectedResult, $actual);
    }

    public function testGetAccountPlan()
    {
        $endpoint       = 'users/gentle/plan';
        $expectedResult = json_encode('dummy');

        $account = $this->getApiMock('Bitbucket\API\Users\Account');
        $account->expects($this->once())
            ->method('requestGet')
            ->with($endpoint)
            ->will( $this->returnValue($expectedResult) );

        /** @var $account \Bitbucket\API\Users\Account */
        $actual = $account->plan('gentle');

        $this->assertEquals($expectedResult, $actual);
    }

    public function testGetAccountFollowers()
    {
        $endpoint       = 'users/gentle/followers';
        $expectedResult = json_encode('dummy');

        $account = $this->getApiMock('Bitbucket\API\Users\Account');
        $account->expects($this->once())
            ->method('requestGet')
            ->with($endpoint)
            ->will( $this->returnValue($expectedResult) );

        /** @var $account \Bitbucket\API\Users\Account */
        $actual = $account->followers('gentle');

        $this->assertEquals($expectedResult, $actual);
    }

    public function testGetAccountEvents()
    {
        $endpoint       = 'users/gentle/events';
        $expectedResult = json_encode('dummy');

        $account = $this->getApiMock('Bitbucket\API\Users\Account');
        $account->expects($this->once())
            ->method('requestGet')
            ->with($endpoint)
            ->will( $this->returnValue($expectedResult) );

        /** @var $account \Bitbucket\API\Users\Account */
        $actual = $account->events('gentle');

        $this->assertEquals($expectedResult, $actual);
    }
}