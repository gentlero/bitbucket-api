<?php

namespace Bitbucket\Tests\API\Repositories;

use Bitbucket\Tests\API as Tests;
use Bitbucket\API;

class DeploykeysTest extends Tests\TestCase
{
    public function testGetAllKeys()
    {
        $endpoint       = 'repositories/gentle/eof/deploy-keys';
        $expectedResult = json_encode('dummy');

        $dkey = $this->getApiMock('Bitbucket\API\Repositories\Deploykeys');
        $dkey->expects($this->once())
            ->method('requestGet')
            ->with($endpoint)
            ->will( $this->returnValue($expectedResult) );

        /** @var $dkey \Bitbucket\API\Repositories\Deploykeys */
        $actual = $dkey->all('gentle', 'eof');

        $this->assertEquals($expectedResult, $actual);
    }

    public function testGetSingleKey()
    {
        $endpoint       = 'repositories/gentle/eof/deploy-keys/3';
        $expectedResult = json_encode('dummy');

        $dkey = $this->getApiMock('Bitbucket\API\Repositories\Deploykeys');
        $dkey->expects($this->once())
            ->method('requestGet')
            ->with($endpoint)
            ->will( $this->returnValue($expectedResult) );

        /** @var $dkey \Bitbucket\API\Repositories\Deploykeys */
        $actual = $dkey->get('gentle', 'eof', 3);

        $this->assertEquals($expectedResult, $actual);
    }

    public function testAddNewKeySuccess()
    {
        $endpoint       = 'repositories/gentle/eof/deploy-keys';
        $params         = array(
            'key'   => 'ssh-rsa [...]',
            'label' => 'dummy key'
        );

        $dkey = $this->getApiMock('Bitbucket\API\Repositories\Deploykeys');
        $dkey->expects($this->once())
            ->method('requestPost')
            ->with($endpoint, $params);

        /** @var $dkey \Bitbucket\API\Repositories\Deploykeys */
        $dkey->create('gentle', 'eof', 'ssh-rsa [...]', 'dummy key');
    }

    public function testUpdateKeySuccess()
    {
        $endpoint       = 'repositories/gentle/eof/deploy-keys/3';
        $params         = array('label' => 'test key');

        $dkey = $this->getApiMock('Bitbucket\API\Repositories\Deploykeys');
        $dkey->expects($this->once())
            ->method('requestPut')
            ->with($endpoint, $params);

        /** @var $dkey \Bitbucket\API\Repositories\Deploykeys */
        $dkey->update('gentle', 'eof', 3, $params);
    }

    public function testDeleteKeySuccess()
    {
        $endpoint       = 'repositories/gentle/eof/deploy-keys/3';

        $dkey = $this->getApiMock('Bitbucket\API\Repositories\Deploykeys');
        $dkey->expects($this->once())
            ->method('requestDelete')
            ->with($endpoint);

        /** @var $dkey \Bitbucket\API\Repositories\Deploykeys */
        $dkey->delete('gentle', 'eof', '3');
    }
}