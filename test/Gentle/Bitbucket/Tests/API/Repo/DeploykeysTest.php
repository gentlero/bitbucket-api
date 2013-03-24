<?php

namespace Gentle\Bitbucket\Tests\API\Repo;

use Gentle\Bitbucket\Tests\API as Tests;
use Gentle\Bitbucket\API;

class DeploykeysTest extends Tests\TestCase
{
    public function testGetAllKeys()
    {
        $endpoint       = 'repositories/gentle/eof/deploy-keys';
        $expectedResult = json_encode('dummy');

        $dkey = $this->getApiMock('Gentle\Bitbucket\API\Repo\Deploykeys');
        $dkey->expects($this->once())
            ->method('requestGet')
            ->with($endpoint)
            ->will( $this->returnValue($expectedResult) );

        /** @var $dkey \Gentle\Bitbucket\API\Repo\Deploykeys */
        $actual = $dkey->all('gentle', 'eof');

        $this->assertEquals($expectedResult, $actual);
    }
}