<?php

namespace Bitbucket\Tests\API\Repositories;

use Bitbucket\Tests\API as Tests;
use Bitbucket\API;

class ServicesTest extends Tests\TestCase
{
    public function testGetAllServices()
    {
        $endpoint       = 'repositories/gentle/eof/services';
        $expectedResult = $this->addFakeResponse(json_encode('dummy'));

        /** @var $services \Bitbucket\API\Repositories\Services */
        $services = $this->getApiMock('Bitbucket\API\Repositories\Services');

        $actual = $services->all('gentle', 'eof');

        $this->assertEquals($expectedResult, $actual);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('GET', $request->getMethod());
    }

    public function testGetSingleservice()
    {
        $endpoint       = 'repositories/gentle/eof/services/3';
        $expectedResult = $this->addFakeResponse(json_encode('dummy'));

        /** @var $service \Bitbucket\API\Repositories\Services */
        $service = $this->getApiMock('Bitbucket\API\Repositories\Services');

        $actual = $service->get('gentle', 'eof', 3);

        $this->assertEquals($expectedResult, $actual);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('GET', $request->getMethod());
    }

    public function testCreateServiceSuccess()
    {
        $endpoint       = 'repositories/gentle/eof/services';

        /** @var $service \Bitbucket\API\Repositories\Services */
        $service = $this->getApiMock('Bitbucket\API\Repositories\Services');

        $service->create('gentle', 'eof', 'POST', array('URL' => 'https://example.com/post'));

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('POST', $request->getMethod());
        $this->assertSame('type=POST&URL=https%3A%2F%2Fexample.com%2Fpost', $request->getBody()->getContents());
    }

    public function testUpdateServiceSuccess()
    {
        $endpoint       = 'repositories/gentle/eof/services/3';

        /** @var $service \Bitbucket\API\Repositories\Services */
        $service = $this->getApiMock('Bitbucket\API\Repositories\Services');

        $service->update('gentle', 'eof', 3, array('URL' => 'https://example.com'));

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('PUT', $request->getMethod());
        $this->assertSame('URL=https%3A%2F%2Fexample.com', $request->getBody()->getContents());
    }

    public function testDeleteServiceSuccess()
    {
        $endpoint       = 'repositories/gentle/eof/services/3';

        /** @var $service \Bitbucket\API\Repositories\Services */
        $service = $this->getApiMock('Bitbucket\API\Repositories\Services');

        $service->delete('gentle', 'eof', 3);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('DELETE', $request->getMethod());
    }
}
