<?php

namespace Bitbucket\Tests\API\Repositories;

use Bitbucket\Tests\API as Tests;
use Bitbucket\API;

class DeploykeysTest extends Tests\TestCase
{
    public function testGetAllKeys()
    {
        $endpoint       = 'repositories/gentle/eof/deploy-keys';
        $expectedResult = $this->addFakeResponse(json_encode('dummy'));

        /** @var $dkey \Bitbucket\API\Repositories\Deploykeys */
        $dkey = $this->getApiMock('Bitbucket\API\Repositories\Deploykeys');

        $actual = $dkey->all('gentle', 'eof');

        $this->assertEquals($expectedResult, $actual);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('GET', $request->getMethod());
    }

    public function testGetSingleKey()
    {
        $endpoint       = 'repositories/gentle/eof/deploy-keys/3';
        $expectedResult = $this->addFakeResponse(json_encode('dummy'));

        /** @var $dkey \Bitbucket\API\Repositories\Deploykeys */
        $dkey = $this->getApiMock('Bitbucket\API\Repositories\Deploykeys');

        $actual = $dkey->get('gentle', 'eof', 3);

        $this->assertEquals($expectedResult, $actual);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('GET', $request->getMethod());
    }

    public function testAddNewKeySuccess()
    {
        $endpoint       = 'repositories/gentle/eof/deploy-keys';

        /** @var $dkey \Bitbucket\API\Repositories\Deploykeys */
        $dkey = $this->getApiMock('Bitbucket\API\Repositories\Deploykeys');

        $dkey->create('gentle', 'eof', 'ssh-rsa [...]', 'dummy key');

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('POST', $request->getMethod());
        $this->assertSame('key=ssh-rsa+%5B...%5D&label=dummy+key', $request->getBody()->getContents());
    }

    public function testUpdateKeySuccess()
    {
        $endpoint       = 'repositories/gentle/eof/deploy-keys/3';
        $params         = array('label' => 'test key');

        /** @var $dkey \Bitbucket\API\Repositories\Deploykeys */
        $dkey = $this->getApiMock('Bitbucket\API\Repositories\Deploykeys');

        $dkey->update('gentle', 'eof', 3, $params);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('PUT', $request->getMethod());
        $this->assertSame('label=test+key', $request->getBody()->getContents());
    }

    public function testDeleteKeySuccess()
    {
        $endpoint       = 'repositories/gentle/eof/deploy-keys/3';

        /** @var $dkey \Bitbucket\API\Repositories\Deploykeys */
        $dkey = $this->getApiMock('Bitbucket\API\Repositories\Deploykeys');

        $dkey->delete('gentle', 'eof', '3');

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('DELETE', $request->getMethod());
    }
}
