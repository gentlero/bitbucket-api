<?php

namespace Bitbucket\Tests\API;

use Bitbucket\API\Repositories;
use Bitbucket\Tests\API as Tests;

class RepositoriesTest extends Tests\TestCase
{
    public function testGetAllRepositories()
    {
        $endpoint       = 'repositories/gentle';
        $expectedResult = $this->addFakeResponse(array('dummy'));

        /** @var \Bitbucket\API\Repositories $repositories */
        $repositories = $this->getApiMock('Bitbucket\API\Repositories');
        $actual         = $repositories->all('gentle');

        $this->assertEquals($expectedResult, $actual);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/2.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('GET', $request->getMethod());
    }
}
