<?php

namespace Bitbucket\Tests\API\Users;

use Bitbucket\Tests\API as Tests;
use Bitbucket\API;

class SshKeysTest extends Tests\TestCase
{
    public function testGetAllSshKeys()
    {
        $endpoint       = 'users/gentle/ssh-keys';
        $expectedResult = $this->addFakeResponse(json_encode('dummy'));

        /** @var $keys \Bitbucket\API\Users\SshKeys */
        $keys = $this->getApiMock('Bitbucket\API\Users\SshKeys');
        $actual = $keys->all('gentle');

        $this->assertEquals($expectedResult, $actual);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('GET', $request->getMethod());
    }

    public function testCreateSshKey()
    {
        $endpoint       = 'users/gentle/ssh-keys';
        $expectedResult = $this->addFakeResponse(json_encode('dummy'));
        $params         = array(
            'key'   => 'key content',
            'label' => 'dummy key'
        );

        /** @var $keys \Bitbucket\API\Users\SshKeys */
        $keys = $this->getApiMock('Bitbucket\API\Users\SshKeys');
        $actual = $keys->create('gentle', $params['key'], $params['label']);

        $this->assertEquals($expectedResult, $actual);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('POST', $request->getMethod());
        $this->assertSame('key=key+content&label=dummy+key', $request->getBody()->getContents());
    }

    public function testUpdateSshKey()
    {
        $endpoint       = 'users/gentle/ssh-keys/12';
        $expectedResult = $this->addFakeResponse(json_encode('dummy'));
        $params         = array(
            'key'   => 'key content'
        );

        /** @var $keys \Bitbucket\API\Users\SshKeys */
        $keys = $this->getApiMock('Bitbucket\API\Users\SshKeys');
        $actual = $keys->update('gentle', 12, $params['key']);

        $this->assertEquals($expectedResult, $actual);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('PUT', $request->getMethod());
        $this->assertSame('key=key+content', $request->getBody()->getContents());
    }

    public function testGetSshKeyContent()
    {
        $endpoint       = 'users/gentle/ssh-keys/2';
        $expectedResult = $this->addFakeResponse(json_encode('dummy'));

        /** @var $keys \Bitbucket\API\Users\SshKeys */
        $keys = $this->getApiMock('Bitbucket\API\Users\SshKeys');
        $actual = $keys->get('gentle', 2);

        $this->assertEquals($expectedResult, $actual);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('GET', $request->getMethod());
    }

    public function testDeleteSshKey()
    {
        $endpoint       = 'users/gentle/ssh-keys/2';
        $expectedResult = $this->addFakeResponse(json_encode('dummy'));

        /** @var $keys \Bitbucket\API\Users\SshKeys */
        $keys = $this->getApiMock('Bitbucket\API\Users\SshKeys');
        $actual = $keys->delete('gentle', 2);

        $this->assertEquals($expectedResult, $actual);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('DELETE', $request->getMethod());
    }
}
