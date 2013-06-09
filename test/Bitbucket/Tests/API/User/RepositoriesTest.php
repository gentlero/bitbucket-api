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
        $expectedResult = json_encode('dummy');

        $repositories = $this->getApiMock('\Bitbucket\API\User\Repositories');
        $repositories->expects($this->once())
            ->method('requestGet')
            ->with($endpoint)
            ->will( $this->returnValue($expectedResult));

        /** @var $repositories \Bitbucket\API\User\Repositories */
        $actual = $repositories->get();

        $this->assertEquals($expectedResult, $actual);
    }

    public function testGetUserRepositoriesFollowingSuccess()
    {
        $endpoint       = 'user/repositories/overview';
        $expectedResult = json_encode('dummy');

        $repositories = $this->getApiMock('\Bitbucket\API\User\Repositories');
        $repositories->expects($this->once())
            ->method('requestGet')
            ->with($endpoint)
            ->will( $this->returnValue($expectedResult));

        /** @var $repositories \Bitbucket\API\User\Repositories */
        $actual = $repositories->overview();

        $this->assertEquals($expectedResult, $actual);
    }

    public function testGetUserRepositoriesDashboardSuccess()
    {
        $endpoint       = 'user/repositories/dashboard';
        $expectedResult = json_encode('dummy');

        $repositories = $this->getApiMock('\Bitbucket\API\User\Repositories');
        $repositories->expects($this->once())
            ->method('requestGet')
            ->with($endpoint)
            ->will( $this->returnValue($expectedResult));

        /** @var $repositories \Bitbucket\API\User\Repositories */
        $actual = $repositories->dashboard();

        $this->assertEquals($expectedResult, $actual);
    }
}