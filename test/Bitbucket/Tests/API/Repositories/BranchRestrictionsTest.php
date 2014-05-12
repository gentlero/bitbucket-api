<?php

namespace Bitbucket\Tests\API\Repositories;

use Bitbucket\Tests\API as Tests;
use Bitbucket\API;

class BranchRestrictionsTest extends Tests\TestCase
{
    public function testGetAllRestrictions()
    {
        $endpoint       = 'repositories/gentle/eof/branch-restrictions';
        $expectedResult = $this->fakeResponse(array('dummy'));

        $client = $this->getHttpClientMock();
        $client->expects($this->once())
            ->method('get')
            ->with($endpoint)
            ->will($this->returnValue($expectedResult));

        /** @var \Bitbucket\API\Repositories\BranchRestrictions $restrictions */
        $restrictions   = $this->getClassMock('Bitbucket\API\Repositories\BranchRestrictions', $client);
        $actual         = $restrictions->all('gentle', 'eof', array('dummy'));

        $this->assertEquals($expectedResult, $actual);
    }

    public function testCreateRestrictionFromArray()
    {
        $endpoint       = 'repositories/gentle/eof/branch-restrictions';
        $params         = array(
            'kind' => 'push'
        );

        $client = $this->getHttpClientMock();
        $client->expects($this->once())
            ->method('post')
            ->with($endpoint, json_encode($params));

        /** @var \Bitbucket\API\Repositories\BranchRestrictions $restrictions */
        $restrictions   = $this->getClassMock('Bitbucket\API\Repositories\BranchRestrictions', $client);

        $restrictions->create('gentle', 'eof', $params);
    }

    public function testCreateRestrictionFromJSON()
    {
        $endpoint       = 'repositories/gentle/eof/branch-restrictions';
        $params         = json_encode(array(
            'kind' => 'push'
        ));

        $client = $this->getHttpClientMock();
        $client->expects($this->once())
            ->method('post')
            ->with($endpoint, $params);

        /** @var \Bitbucket\API\Repositories\BranchRestrictions $restrictions */
        $restrictions   = $this->getClassMock('Bitbucket\API\Repositories\BranchRestrictions', $client);

        $restrictions->create('gentle', 'eof', $params);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testCreateRestrictionFromArrayShouldFailWithInvalidRestrictionKind()
    {
        $params         = array(
            'kind' => 'invalid'
        );

        $restrictions   = new \Bitbucket\API\Repositories\BranchRestrictions;

        $restrictions->create('gentle', 'eof', $params);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testCreateRestrictionFromJSONShouldFailWithInvalidRestrictionKind()
    {
        $params         = json_encode(array(
            'kind' => 'invalid'
        ));

        $restrictions   = new \Bitbucket\API\Repositories\BranchRestrictions;

        $restrictions->create('gentle', 'eof', $params);
    }
}
