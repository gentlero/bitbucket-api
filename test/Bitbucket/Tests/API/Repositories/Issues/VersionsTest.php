<?php

namespace Bitbucket\Tests\API\Repositories\Issues;

use Bitbucket\Tests\API as Tests;
use Bitbucket\API;

class VersionsTest extends Tests\TestCase
{
    public function testGetAllComponentsSuccess()
    {
        $endpoint       = 'repositories/gentle/eof/issues/versions';
        $expectedResult = $this->addFakeResponse(json_encode('dummy'));

        /** @var $versions \Bitbucket\API\Repositories\Issues\Versions */
        $versions = $this->getApiMock('Bitbucket\API\Repositories\Issues\Versions');

        $actual = $versions->all('gentle', 'eof');

        $this->assertEquals($expectedResult, $actual);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('GET', $request->getMethod());
    }

    public function testGetSingleVersionSuccess()
    {
        $endpoint       = 'repositories/gentle/eof/issues/versions/2';
        $expectedResult = $this->addFakeResponse(json_encode('dummy'));

        /** @var $version \Bitbucket\API\Repositories\Issues\Versions */
        $version = $this->getApiMock('Bitbucket\API\Repositories\Issues\Versions');

        $actual = $version->get('gentle', 'eof', 2);

        $this->assertEquals($expectedResult, $actual);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('GET', $request->getMethod());
    }

    public function testCreateVersionSuccess()
    {
        $endpoint       = 'repositories/gentle/eof/issues/versions';

        /** @var $version \Bitbucket\API\Repositories\Issues\Versions */
        $version = $this->getApiMock('Bitbucket\API\Repositories\Issues\Versions');

        $version->create('gentle', 'eof', 'dummy');

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('POST', $request->getMethod());
        $this->assertSame('name=dummy', $request->getBody()->getContents());
    }

    public function testUpdateVersionSuccess()
    {
        $endpoint       = 'repositories/gentle/eof/issues/versions/3';

        /** @var $version \Bitbucket\API\Repositories\Issues\Versions */
        $version = $this->getApiMock('Bitbucket\API\Repositories\Issues\Versions');

        $version->update('gentle', 'eof', 3, 'dummy');

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('PUT', $request->getMethod());
        $this->assertSame('name=dummy', $request->getBody()->getContents());
    }

    public function testDeleteVersionSuccess()
    {
        $endpoint       = 'repositories/gentle/eof/issues/versions/3';

        /** @var $version \Bitbucket\API\Repositories\Issues\Versions */
        $version = $this->getApiMock('Bitbucket\API\Repositories\Issues\Versions');

        $version->delete('gentle', 'eof', 3);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('DELETE', $request->getMethod());
    }
}
