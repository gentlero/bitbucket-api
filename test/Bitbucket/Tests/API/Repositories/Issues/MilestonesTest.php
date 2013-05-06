<?php

namespace Bitbucket\Tests\API\Repositories\Issues;

use Bitbucket\Tests\API as Tests;
use Bitbucket\API;

class MilestonesTest extends Tests\TestCase
{
    public function testGetAllMilestonesSuccess()
    {
        $endpoint       = 'repositories/gentle/eof/issues/milestones';
        $expectedResult = json_encode('dummy');

        $milestones = $this->getApiMock('Bitbucket\API\Repositories\Issues\Milestones');
        $milestones->expects($this->once())
            ->method('requestGet')
            ->with($endpoint)
            ->will( $this->returnValue($expectedResult) );

        /** @var $milestones \Bitbucket\API\Repositories\Issues\Milestones */
        $actual = $milestones->all('gentle', 'eof');

        $this->assertEquals($expectedResult, $actual);
    }

    public function testGetSingleMilestoneSuccess()
    {
        $endpoint       = 'repositories/gentle/eof/issues/milestones/2';
        $expectedResult = json_encode('dummy');

        $milestone = $this->getApiMock('Bitbucket\API\Repositories\Issues\Milestones');
        $milestone->expects($this->once())
            ->method('requestGet')
            ->with($endpoint)
            ->will( $this->returnValue($expectedResult) );

        /** @var $milestone \Bitbucket\API\Repositories\Issues\Milestones */
        $actual = $milestone->get('gentle', 'eof', 2);

        $this->assertEquals($expectedResult, $actual);
    }

    public function testCreateMilestoneSuccess()
    {
        $endpoint       = 'repositories/gentle/eof/issues/milestones';
        $params         = array('name' => 'dummy');

        $milestone = $this->getApiMock('Bitbucket\API\Repositories\Issues\Milestones');
        $milestone->expects($this->once())
            ->method('requestPost')
            ->with($endpoint, $params);

        /** @var $milestone \Bitbucket\API\Repositories\Issues\Milestones */
        $milestone->create('gentle', 'eof', 'dummy');
    }

    public function testUpdateMilestoneSuccess()
    {
        $endpoint       = 'repositories/gentle/eof/issues/milestones/3';
        $params         = array('name' => 'dummy');

        $milestone = $this->getApiMock('Bitbucket\API\Repositories\Issues\Milestones');
        $milestone->expects($this->once())
            ->method('requestPut')
            ->with($endpoint, $params);

        /** @var $milestone \Bitbucket\API\Repositories\Issues\Milestones */
        $milestone->update('gentle', 'eof', 3, 'dummy');
    }

    public function testDeleteMilestoneSuccess()
    {
        $endpoint       = 'repositories/gentle/eof/issues/milestones/3';

        $milestone = $this->getApiMock('Bitbucket\API\Repositories\Issues\Milestones');
        $milestone->expects($this->once())
            ->method('requestDelete')
            ->with($endpoint);

        /** @var $milestone \Bitbucket\API\Repositories\Issues\Milestones */
        $milestone->delete('gentle', 'eof', 3);
    }
}