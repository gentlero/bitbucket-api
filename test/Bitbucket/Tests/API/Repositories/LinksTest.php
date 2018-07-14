<?php

namespace Bitbucket\Tests\API\Repositories;

use Bitbucket\Tests\API as Tests;
use Bitbucket\API;

class LinksTest extends Tests\TestCase
{
    public function testGetAllLinks()
    {
        $endpoint       = 'repositories/gentle/eof/links';
        $expectedResult = $this->addFakeResponse(json_encode('dummy'));

        /** @var $links \Bitbucket\API\Repositories\Links */
        $links = $this->getApiMock('Bitbucket\API\Repositories\Links');

        $actual = $links->all('gentle', 'eof');

        $this->assertEquals($expectedResult, $actual);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('GET', $request->getMethod());
    }

    public function testGetSingleLink()
    {
        $endpoint       = 'repositories/gentle/eof/links/3';
        $expectedResult = $this->addFakeResponse(json_encode('dummy'));

        /** @var $links \Bitbucket\API\Repositories\Links */
        $links = $this->getApiMock('Bitbucket\API\Repositories\Links');

        $actual = $links->get('gentle', 'eof', 3);

        $this->assertEquals($expectedResult, $actual);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('GET', $request->getMethod());
    }

    public function testCreateLinkSuccess()
    {
        $endpoint       = 'repositories/gentle/eof/links';
        $params = [
            'handler' => 'custom',
            'link_url' => 'https://example.com',
            'link_key' => 'my-project-key',
        ];

        /** @var $link \Bitbucket\API\Repositories\Links */
        $link = $this->getApiMock('Bitbucket\API\Repositories\Links');

        $link->create('gentle', 'eof', 'custom', 'https://example.com', 'my-project-key');

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('POST', $request->getMethod());
        $this->assertSame(http_build_query($params), $request->getBody()->getContents());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testCreateLinkInvalidArguments()
    {
        /** @var $link \Bitbucket\API\Repositories\Links */
        $link = $this->getApiMock('Bitbucket\API\Repositories\Links');

        $link->create('gentle', 'eof', 'invalid', 'https://example.com', 'my-project-key');

        $this->assertNull($this->mockClient->getLastRequest());
    }

    public function testUpdateLinkSuccess()
    {
        $endpoint       = 'repositories/gentle/eof/links/3';
        $params = [
            'link_url' => 'https://example.com',
            'link_key' => 'my-project-key'
        ];

        /** @var $link \Bitbucket\API\Repositories\Links */
        $link = $this->getApiMock('Bitbucket\API\Repositories\Links');

        $link->update('gentle', 'eof', 3, 'https://example.com', 'my-project-key');

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('PUT', $request->getMethod());
        $this->assertSame(http_build_query($params), $request->getBody()->getContents());
    }

    public function testDeleteLinkSuccess()
    {
        $endpoint       = 'repositories/gentle/eof/links/3';

        /** @var $link \Bitbucket\API\Repositories\Links */
        $link = $this->getApiMock('Bitbucket\API\Repositories\Links');

        $link->delete('gentle', 'eof', 3);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('DELETE', $request->getMethod());
    }
}
