<?php

namespace Bitbucket\Tests\API\Repositories;

use Bitbucket\Tests\API as Tests;
use Bitbucket\API;

class SrcTest extends Tests\TestCase
{
    public function testListRepoSrc()
    {
        $endpoint       = 'repositories/gentle/eof/src/1e10ffe//lib';
        $expectedResult = $this->addFakeResponse(json_encode('dummy'));

        /** @var $src \Bitbucket\API\Repositories\Src */
        $src = $this->getApiMock('Bitbucket\API\Repositories\Src');

        $actual = $src->get('gentle', 'eof', '1e10ffe', '/lib');

        $this->assertEquals($expectedResult, $actual);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('GET', $request->getMethod());
    }

    public function testSrcGetRawContent()
    {
        $endpoint       = 'repositories/gentle/eof/raw/1e10ffe/lib/Gentle/Bitbucket/API/Repositories/Services.php';
        $expectedResult = $this->addFakeResponse(json_encode('dummy'));

        /** @var $src \Bitbucket\API\Repositories\Src */
        $src = $this->getApiMock('Bitbucket\API\Repositories\Src');

        $actual = $src->raw('gentle', 'eof', '1e10ffe', 'lib/Gentle/Bitbucket/API/Repositories/Services.php');

        $this->assertEquals($expectedResult, $actual);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('GET', $request->getMethod());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testSrcCreateWithInvalidParams()
    {
        /** @var \Bitbucket\API\Repositories\Src $src */
        $src   = $this->getApiMock('Bitbucket\API\Repositories\Src');

        $src->create('gentle', 'eof', array());
        $src->create('gentle', 'eof', array(3));
    }

    public function testSrcCreateFile()
    {
        $endpoint       = 'repositories/gentle/eof/src';
        $params         = array(
            '/testfile' => 'dummy',
            'author' => 'Gentle <noreply@gentle.com>',
            'message' => 'Test commit'
        );

        /** @var \Bitbucket\API\Repositories\Src $src */
        $src   = $this->getApiMock('Bitbucket\API\Repositories\Src');

        $src->create('gentle', 'eof', $params);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/2.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('POST', $request->getMethod());
        $this->assertSame(http_build_query($params), $request->getBody()->getContents());
    }

    public function testSrcCreateBranch()
    {
        $endpoint       = 'repositories/gentle/eof/src';
        $params         = array(
            'branch' => 'new-branch',
            'author' => 'Gentle <noreply@gentle.com>',
            'message' => 'Test create branch'
        );

        /** @var \Bitbucket\API\Repositories\Src $src */
        $src   = $this->getApiMock('Bitbucket\API\Repositories\Src');

        $src->create('gentle', 'eof', $params);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/2.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('POST', $request->getMethod());
        $this->assertSame(http_build_query($params), $request->getBody()->getContents());
    }
}
