<?php

namespace Bitbucket\Tests\API\Users;

use Bitbucket\Tests\API as Tests;
use Bitbucket\API;

class SshKeysTest extends Tests\TestCase
{
    public function testGetSshKeys()
    {
        $endpoint       = 'users/gentle/ssh-keys';
        $expectedResult = json_encode('dummy');

        $keys = $this->getApiMock('Bitbucket\API\Users\SshKeys');
        $keys->expects($this->once())
            ->method('requestGet')
            ->with($endpoint)
            ->will( $this->returnValue($expectedResult) );

        /** @var $keys \Bitbucket\API\Users\SshKeys */
        $actual = $keys->get('gentle');

        $this->assertEquals($expectedResult, $actual);
    }
}