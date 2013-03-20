<?php

namespace Gentle\Bitbucket\Tests\API\Repo\Issues;

use Gentle\Bitbucket\Tests\API as Tests;
use Gentle\Bitbucket\API;

class MilestonesTest extends Tests\TestCase
{
    public function testGetAllMilestonesSuccess()
    {
        $endpoint       = 'repositories/gentle/eof/issues/milestones';
        $expectedResult = json_encode('dummy');

        $milestones = $this->getApiMock('Gentle\Bitbucket\API\Repo\Issues\Milestones');
        $milestones->expects($this->once())
            ->method('requestGet')
            ->with($endpoint)
            ->will( $this->returnValue($expectedResult) );

        /** @var $milestones \Gentle\Bitbucket\API\Repo\Issues\Milestones */
        $actual = $milestones->all('gentle', 'eof');

        $this->assertEquals($expectedResult, $actual);
    }
}