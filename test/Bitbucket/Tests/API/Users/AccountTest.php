<?php

namespace Bitbucket\Tests\API\Users;

use Bitbucket\Tests\API as Tests;
use Bitbucket\API;

class AccountTest extends Tests\TestCase
{
    public function testGetAccountProfile()
    {
        $endpoint       = 'users/gentle';
        $expectedResult = $this->addFakeResponse(json_encode('dummy'));

        /** @var $account \Bitbucket\API\Users\Account */
        $account = $this->getApiMock('Bitbucket\API\Users\Account');

        $actual = $account->profile('gentle');

        $this->assertEquals($expectedResult, $actual);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('GET', $request->getMethod());
    }

    public function testGetAccountPlan()
    {
        $endpoint       = 'users/gentle/plan';
        $expectedResult = $this->addFakeResponse(json_encode('dummy'));

        /** @var $account \Bitbucket\API\Users\Account */
        $account = $this->getApiMock('Bitbucket\API\Users\Account');

        $actual = $account->plan('gentle');

        $this->assertEquals($expectedResult, $actual);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('GET', $request->getMethod());
    }

    public function testGetAccountFollowers()
    {
        $endpoint       = 'users/gentle/followers';
        $expectedResult = $this->addFakeResponse(json_encode('dummy'));

        /** @var $account \Bitbucket\API\Users\Account */
        $account = $this->getApiMock('Bitbucket\API\Users\Account');

        $actual = $account->followers('gentle');

        $this->assertEquals($expectedResult, $actual);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('GET', $request->getMethod());
    }

    public function testGetAccountEvents()
    {
        $endpoint       = 'users/gentle/events';
        $expectedResult = $this->addFakeResponse(json_encode('dummy'));

        /** @var $account \Bitbucket\API\Users\Account */
        $account = $this->getApiMock('Bitbucket\API\Users\Account');

        $actual = $account->events('gentle');

        $this->assertEquals($expectedResult, $actual);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('GET', $request->getMethod());
    }
}
