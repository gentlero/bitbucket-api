<?php

namespace Bitbucket\Tests\API\Users;

use Bitbucket\Tests\API as Tests;
use Bitbucket\API;

class SshKeysTest extends Tests\TestCase
{
    public function testGetAllSshKeys()
    {
        $endpoint       = 'users/gentle/ssh-keys';
        $expectedResult = json_encode('dummy');

        $keys = $this->getApiMock('Bitbucket\API\Users\SshKeys');
        $keys->expects($this->once())
            ->method('requestGet')
            ->with($endpoint)
            ->will( $this->returnValue($expectedResult) );

        /** @var $keys \Bitbucket\API\Users\SshKeys */
        $actual = $keys->all('gentle');

        $this->assertEquals($expectedResult, $actual);
    }

    public function testCreateSshKey()
    {
        $endpoint       = 'users/gentle/ssh-keys';
        $expectedResult = json_encode('dummy');
        $params         = array(
            'key'   => 'key content',
            'label' => 'dummy key'
        );

        $keys = $this->getApiMock('Bitbucket\API\Users\SshKeys');
        $keys->expects($this->once())
            ->method('requestPost')
            ->with($endpoint, $params)
            ->will( $this->returnValue($expectedResult) );

        /** @var $keys \Bitbucket\API\Users\SshKeys */
        $actual = $keys->create('gentle', $params['key'], $params['label']);

        $this->assertEquals($expectedResult, $actual);
    }

    public function testUpdateSshKey()
    {
        $endpoint       = 'users/gentle/ssh-keys/12';
        $expectedResult = json_encode('dummy');
        $params         = array(
            'key'   => 'key content'
        );

        $keys = $this->getApiMock('Bitbucket\API\Users\SshKeys');
        $keys->expects($this->once())
            ->method('requestPut')
            ->with($endpoint, $params)
            ->will( $this->returnValue($expectedResult) );

        /** @var $keys \Bitbucket\API\Users\SshKeys */
        $actual = $keys->update('gentle', 12, $params['key']);

        $this->assertEquals($expectedResult, $actual);
    }

    public function testGetSshKeyContent()
    {
        $endpoint       = 'users/gentle/ssh-keys/2';
        $expectedResult = json_encode('dummy');

        $keys = $this->getApiMock('Bitbucket\API\Users\SshKeys');
        $keys->expects($this->once())
            ->method('requestGet')
            ->with($endpoint)
            ->will( $this->returnValue($expectedResult) );

        /** @var $keys \Bitbucket\API\Users\SshKeys */
        $actual = $keys->get('gentle', 2);

        $this->assertEquals($expectedResult, $actual);
    }

    public function testDeleteSshKey()
    {
        $endpoint       = 'users/gentle/ssh-keys/2';
        $expectedResult = json_encode('dummy');

        $keys = $this->getApiMock('Bitbucket\API\Users\SshKeys');
        $keys->expects($this->once())
            ->method('requestDelete')
            ->with($endpoint)
            ->will( $this->returnValue($expectedResult) );

        /** @var $keys \Bitbucket\API\Users\SshKeys */
        $actual = $keys->delete('gentle', 2);

        $this->assertEquals($expectedResult, $actual);
    }
}