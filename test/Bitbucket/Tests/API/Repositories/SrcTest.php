<?php

namespace Bitbucket\Tests\API\Repositories;

use Bitbucket\Tests\API as Tests;
use Bitbucket\API;

class SrcTest extends Tests\TestCase
{
    public function testListRepoSrc()
    {
        $endpoint       = 'repositories/gentle/eof/src/1e10ffe//lib';
        $expectedResult = $this->fakeResponse(array('dummy'));

        $client = $this->getHttpClientMock();
        $client->expects($this->once())
            ->method('get')
            ->with($endpoint)
            ->will( $this->returnValue($expectedResult) );

        /** @var $src \Bitbucket\API\Repositories\Src */
        $src    = $this->getClassMock('Bitbucket\API\Repositories\Src', $client);
        $actual = $src->get('gentle', 'eof', '1e10ffe', '/lib');

        $this->assertEquals($expectedResult, $actual);
    }

    public function testSrcGetRawContent()
    {
        $endpoint       = 'repositories/gentle/eof/src/1e10ffe/lib/Gentle/Bitbucket/API/Repositories/Services.php';
        $expectedResult = $this->fakeResponse(array('dummy'));

        $client = $this->getHttpClientMock();
        $client->expects($this->once())
            ->method('get')
            ->with($endpoint)
            ->will( $this->returnValue($expectedResult) );

        /** @var $src \Bitbucket\API\Repositories\Src */
        $src    = $this->getClassMock('Bitbucket\API\Repositories\Src', $client);
        $actual = $src->get('gentle', 'eof', '1e10ffe', 'lib/Gentle/Bitbucket/API/Repositories/Services.php');

        $this->assertEquals($expectedResult, $actual);
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

        $client = $this->getHttpClientMock();
        $client->expects($this->once())
            ->method('post')
            ->with($endpoint, $params);

        /** @var \Bitbucket\API\Repositories\Src $src */
        $src   = $this->getClassMock('Bitbucket\API\Repositories\Src', $client);

        $src->create('gentle', 'eof', $params);
    }

    public function testSrcCreateBranch()
    {
        $endpoint       = 'repositories/gentle/eof/src';
        $params         = array(
            'branch' => 'new-branch',
            'author' => 'Gentle <noreply@gentle.com>',
            'message' => 'Test create branch'
        );

        $client = $this->getHttpClientMock();
        $client->expects($this->once())
            ->method('post')
            ->with($endpoint, $params);

        /** @var \Bitbucket\API\Repositories\Src $src */
        $src   = $this->getClassMock('Bitbucket\API\Repositories\Src', $client);

        $src->create('gentle', 'eof', $params);
    }
}
