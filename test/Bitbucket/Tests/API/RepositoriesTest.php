<?php

namespace Bitbucket\Tests\API;

use Bitbucket\API\Repositories;
use Bitbucket\Tests\API as Tests;

class RepositoriesTest extends Tests\TestCase
{
    public function testGetAllRepositories()
    {
        $endpoint       = 'repositories/gentle';
        $expectedResult = $this->fakeResponse(array('dummy'));

        $client = $this->getHttpClientMock();
        $client->expects($this->once())
            ->method('get')
            ->with($endpoint)
            ->will($this->returnValue($expectedResult));

        /** @var \Bitbucket\API\Repositories $repositories */
        $repositories = $this->getClassMock('Bitbucket\API\Repositories', $client);
        $actual         = $repositories->all('gentle');

        $this->assertEquals($expectedResult, $actual);
    }
}
