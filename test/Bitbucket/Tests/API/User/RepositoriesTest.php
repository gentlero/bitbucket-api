<?php

/*
 * This file is part of the bitbucket_api package.
 *
 * (c) Alexandru G. <alex@gentle.ro>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Bitbucket\Tests\API\User;

use Bitbucket\Tests\API as Tests;
use Bitbucket\API;

/**
 * RepositoriesTest class
 *
 * [Class description]
 *
 * @author  Alexandru G.    <alex@gentle.ro>
 */
class RepositoriesTest extends Tests\TestCase
{
    public function testGetUserRepositoriesVisibleSuccess()
    {
        $endpoint       = 'user/repositories';
        $expectedResult = $this->addFakeResponse(json_encode('dummy'));

        /** @var $repositories \Bitbucket\API\User\Repositories */
        $repositories = $this->getApiMock('\Bitbucket\API\User\Repositories');

        $actual = $repositories->get();

        $this->assertEquals($expectedResult, $actual);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('GET', $request->getMethod());
    }

    public function testGetUserRepositoriesFollowingSuccess()
    {
        $endpoint       = 'user/repositories/overview';
        $expectedResult = $this->addFakeResponse(json_encode('dummy'));

        /** @var $repositories \Bitbucket\API\User\Repositories */
        $repositories = $this->getApiMock('\Bitbucket\API\User\Repositories');

        $actual = $repositories->overview();

        $this->assertEquals($expectedResult, $actual);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('GET', $request->getMethod());
    }

    public function testGetUserRepositoriesDashboardSuccess()
    {
        $endpoint       = 'user/repositories/dashboard';
        $expectedResult = $this->addFakeResponse(json_encode('dummy'));

        /** @var $repositories \Bitbucket\API\User\Repositories */
        $repositories = $this->getApiMock('\Bitbucket\API\User\Repositories');

        $actual = $repositories->dashboard();

        $this->assertEquals($expectedResult, $actual);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('GET', $request->getMethod());
    }
}
