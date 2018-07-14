<?php

namespace Bitbucket\Tests\API\Repositories\Issues;

use Bitbucket\Tests\API as Tests;
use Bitbucket\API;

class ComponentsTest extends Tests\TestCase
{
    public function testGetAllComponentsSuccess()
    {
        $endpoint       = 'repositories/gentle/eof/issues/components';
        $expectedResult = $this->addFakeResponse(json_encode('dummy'));

        /** @var $components \Bitbucket\API\Repositories\Issues\Components */
        $components = $this->getApiMock('Bitbucket\API\Repositories\Issues\Components');

        $actual = $components->all('gentle', 'eof');

        $this->assertEquals($expectedResult, $actual);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('GET', $request->getMethod());
    }

    public function testGetSingleComponentSuccess()
    {
        $endpoint       = 'repositories/gentle/eof/issues/components/2';
        $expectedResult = $this->addFakeResponse(json_encode('dummy'));

        /** @var $components \Bitbucket\API\Repositories\Issues\Components */
        $components = $this->getApiMock('Bitbucket\API\Repositories\Issues\Components');

        $actual = $components->get('gentle', 'eof', 2);

        $this->assertEquals($expectedResult, $actual);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('GET', $request->getMethod());
    }

    public function testCreateComponentSuccess()
    {
        $endpoint       = 'repositories/gentle/eof/issues/components';

        /** @var $component \Bitbucket\API\Repositories\Issues\Components */
        $component = $this->getApiMock('Bitbucket\API\Repositories\Issues\Components');

        $component->create('gentle', 'eof', 'dummy');

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('POST', $request->getMethod());
        $this->assertSame('name=dummy', $request->getBody()->getContents());
    }

    public function testUpdateComponentSuccess()
    {
        $endpoint       = 'repositories/gentle/eof/issues/components/3';

        /** @var $component \Bitbucket\API\Repositories\Issues\Components */
        $component = $this->getApiMock('Bitbucket\API\Repositories\Issues\Components');

        $component->update('gentle', 'eof', 3, 'dummy');

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('PUT', $request->getMethod());
        $this->assertSame('name=dummy', $request->getBody()->getContents());
    }

    public function testDeleteComponentSuccess()
    {
        $endpoint       = 'repositories/gentle/eof/issues/components/3';

        /** @var $component \Bitbucket\API\Repositories\Issues\Components */
        $component = $this->getApiMock('Bitbucket\API\Repositories\Issues\Components');

        $component->delete('gentle', 'eof', 3);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('DELETE', $request->getMethod());
    }
}
