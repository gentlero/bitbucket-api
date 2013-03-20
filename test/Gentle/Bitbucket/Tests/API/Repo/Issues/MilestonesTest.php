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

    public function testGetSingleMilestoneSuccess()
    {
        $endpoint       = 'repositories/gentle/eof/issues/milestones/2';
        $expectedResult = json_encode('dummy');

        $milestone = $this->getApiMock('Gentle\Bitbucket\API\Repo\Issues\Milestones');
        $milestone->expects($this->once())
            ->method('requestGet')
            ->with($endpoint)
            ->will( $this->returnValue($expectedResult) );

        /** @var $milestone \Gentle\Bitbucket\API\Repo\Issues\Milestones */
        $actual = $milestone->get('gentle', 'eof', 2);

        $this->assertEquals($expectedResult, $actual);
    }

    public function testCreateMilestoneSuccess()
    {
        $endpoint       = 'repositories/gentle/eof/issues/milestones';
        $params         = array('name' => 'dummy');

        $milestone = $this->getApiMock('Gentle\Bitbucket\API\Repo\Issues\Milestones');
        $milestone->expects($this->once())
            ->method('requestPost')
            ->with($endpoint, $params);

        /** @var $milestone \Gentle\Bitbucket\API\Repo\Issues\Milestones */
        $milestone->create('gentle', 'eof', 'dummy');
    }
}