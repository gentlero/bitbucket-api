<?php

namespace Bitbucket\Tests\API\Repositories;

use Bitbucket\Tests\API as Tests;
use Bitbucket\API;

class ChangesetsTest extends Tests\TestCase
{
    public function testGetAllChangesetsSuccess()
    {
        $endpoint       = 'repositories/gentle/eof/changesets';
        $expectedResult = json_encode('dummy');
        $params         = array(
            'start' => 'aea95f1',
            'limit' => 15
        );

        $changesets = $this->getApiMock('Bitbucket\API\Repositories\Changesets');
        $changesets->expects($this->once())
            ->method('requestGet')
            ->with($endpoint, $params)
            ->will( $this->returnValue($expectedResult) );

        /** @var $changesets \Bitbucket\API\Repositories\Changesets */
        $actual = $changesets->all('gentle', 'eof', 'aea95f1', 15);

        $this->assertEquals($expectedResult, $actual);
    }

    public function testGetSpecificChangesetSuccess()
    {
        $endpoint       = 'repositories/gentle/eof/changesets/aea95f1';
        $expectedResult = json_encode('dummy');

        $changesets = $this->getApiMock('Bitbucket\API\Repositories\Changesets');
        $changesets->expects($this->once())
            ->method('requestGet')
            ->with($endpoint)
            ->will( $this->returnValue($expectedResult) );

        /** @var $changesets \Bitbucket\API\Repositories\Changesets */
        $actual = $changesets->get('gentle', 'eof', 'aea95f1', 15);

        $this->assertEquals($expectedResult, $actual);
    }

    public function testGetChangesetDiffstatSuccess()
    {
        $endpoint       = 'repositories/gentle/eof/changesets/aea95f1/diffstat';
        $expectedResult = json_encode('dummy');

        $changesets = $this->getApiMock('Bitbucket\API\Repositories\Changesets');
        $changesets->expects($this->once())
            ->method('requestGet')
            ->with($endpoint)
            ->will( $this->returnValue($expectedResult) );

        /** @var $changesets \Bitbucket\API\Repositories\Changesets */
        $actual = $changesets->diffstat('gentle', 'eof', 'aea95f1');

        $this->assertEquals($expectedResult, $actual);
    }

    public function testGetChangesetDiffSuccess()
    {
        $endpoint       = 'repositories/gentle/eof/changesets/aea95f1/diff';
        $expectedResult = json_encode('dummy');

        $changesets = $this->getApiMock('Bitbucket\API\Repositories\Changesets');
        $changesets->expects($this->once())
            ->method('requestGet')
            ->with($endpoint)
            ->will( $this->returnValue($expectedResult) );

        /** @var $changesets \Bitbucket\API\Repositories\Changesets */
        $actual = $changesets->diff('gentle', 'eof', 'aea95f1');

        $this->assertEquals($expectedResult, $actual);
    }
}