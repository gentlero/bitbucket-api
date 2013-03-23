<?php

namespace Gentle\Bitbucket\Tests\API\Repo;

use Gentle\Bitbucket\Tests\API as Tests;
use Gentle\Bitbucket\API;

class ChangesetsTest extends Tests\TestCase
{
    public function testGetChangesetsSuccess()
    {
        $endpoint       = 'repositories/gentle/eof/changesets';
        $expectedResult = json_encode('dummy');
        $params         = array(
            'start' => 'aea95f1',
            'limit' => 15
        );

        $changesets = $this->getApiMock('Gentle\Bitbucket\API\Repo\Changesets');
        $changesets->expects($this->once())
            ->method('requestGet')
            ->with($endpoint, $params)
            ->will( $this->returnValue($expectedResult) );

        /** @var $changesets \Gentle\Bitbucket\API\Repo\Changesets */
        $actual = $changesets->get('gentle', 'eof', 'aea95f1', 15);

        $this->assertEquals($expectedResult, $actual);
    }
}