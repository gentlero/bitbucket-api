<?php

namespace Bitbucket\Tests\API\Repositories;

use Bitbucket\Tests\API as Tests;
use Bitbucket\API;

class WikiTest extends Tests\TestCase
{
    public function testGetWikiPage()
    {
        $endpoint       = 'repositories/gentle/eof/wiki/Home';
        $expectedResult = $this->addFakeResponse(json_encode('dummy'));

        /** @var $wiki \Bitbucket\API\Repositories\Wiki */
        $wiki = $this->getApiMock('Bitbucket\API\Repositories\Wiki');

        $actual = $wiki->get('gentle', 'eof', 'Home');

        $this->assertEquals($expectedResult, $actual);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('GET', $request->getMethod());
    }

    public function testCreateWikiPageSuccess()
    {
        $endpoint       = 'repositories/gentle/eof/wiki/Dummy';

        /** @var $wiki \Bitbucket\API\Repositories\Wiki */
        $wiki = $this->getApiMock('Bitbucket\API\Repositories\Wiki');

        $wiki->create('gentle', 'eof', 'Dummy', 'Dummy page content');

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('PUT', $request->getMethod());
        $this->assertSame('data=Dummy+page+content&path=%2FDummy', $request->getBody()->getContents());
    }

    public function testUpdateWikiPageSuccess()
    {
        $endpoint       = 'repositories/gentle/eof/wiki/Dummy';

        /** @var $wiki \Bitbucket\API\Repositories\Wiki */
        $wiki = $this->getApiMock('Bitbucket\API\Repositories\Wiki');

        $wiki->update('gentle', 'eof', 'Dummy', 'Dummy page content', null, '6b81a60');

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('PUT', $request->getMethod());
        $this->assertSame('data=Dummy+page+content&path=%2FDummy&rev=6b81a60', $request->getBody()->getContents());
    }
}
