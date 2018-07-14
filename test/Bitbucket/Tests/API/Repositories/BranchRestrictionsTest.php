<?php

namespace Bitbucket\Tests\API\Repositories;

use Bitbucket\Tests\API as Tests;
use Bitbucket\API;

class BranchRestrictionsTest extends Tests\TestCase
{
    public function testGetAllRestrictions()
    {
        $endpoint       = 'repositories/gentle/eof/branch-restrictions';
        $expectedResult = $this->addFakeResponse(array('dummy'));


        /** @var \Bitbucket\API\Repositories\BranchRestrictions $restrictions */
        $restrictions   = $this->getApiMock('Bitbucket\API\Repositories\BranchRestrictions');
        $actual         = $restrictions->all('gentle', 'eof', array('dummy'));

        $this->assertEquals($expectedResult, $actual);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/2.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('GET', $request->getMethod());
    }

    public function testAddRestrictionType()
    {
        $endpoint       = 'repositories/gentle/eof/branch-restrictions';
        $params         = array(
            'kind' => 'testpermission'
        );


        /** @var \Bitbucket\API\Repositories\BranchRestrictions $restrictions */
        $restrictions   = $this->getApiMock('Bitbucket\API\Repositories\BranchRestrictions');
        $restrictions->addAllowedRestrictionType(array('testpermission'));

        $restrictions->create('gentle', 'eof', $params);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/2.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('POST', $request->getMethod());
        $this->assertSame('{"kind":"testpermission"}', $request->getBody()->getContents());
        $this->assertSame(['application/json'], $request->getHeader('Content-Type'));
    }

    public function testCreateRestrictionFromArray()
    {
        $endpoint       = 'repositories/gentle/eof/branch-restrictions';
        $params         = array(
            'kind' => 'push'
        );

        /** @var \Bitbucket\API\Repositories\BranchRestrictions $restrictions */
        $restrictions   = $this->getApiMock('Bitbucket\API\Repositories\BranchRestrictions');

        $restrictions->create('gentle', 'eof', $params);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/2.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('POST', $request->getMethod());
        $this->assertSame('{"kind":"push"}', $request->getBody()->getContents());
        $this->assertSame(['application/json'], $request->getHeader('Content-Type'));
    }

    public function testCreateRestrictionFromJSON()
    {
        $endpoint       = 'repositories/gentle/eof/branch-restrictions';
        $params         = json_encode(array(
            'kind' => 'push'
        ));

        /** @var \Bitbucket\API\Repositories\BranchRestrictions $restrictions */
        $restrictions   = $this->getApiMock('Bitbucket\API\Repositories\BranchRestrictions');

        $restrictions->create('gentle', 'eof', $params);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/2.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('POST', $request->getMethod());
        $this->assertSame('{"kind":"push"}', $request->getBody()->getContents());
        $this->assertSame(['application/json'], $request->getHeader('Content-Type'));
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testCreateRestrictionWithInvalidParams()
    {
        /** @var \Bitbucket\API\Repositories\BranchRestrictions $restrictions */
        $restrictions   = $this->getApiMock('Bitbucket\API\Repositories\BranchRestrictions');

        $restrictions->create('gentle', 'eof', '');
        $restrictions->create('gentle', 'eof', 3);
        $restrictions->create('gentle', 'eof', "{ 'foo': 'bar' }");
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

    public function testGetSpecificRestriction()
    {
        $endpoint       = 'repositories/gentle/eof/branch-restrictions/1';
        $expectedResult = $this->addFakeResponse(array('dummy'));

        /** @var \Bitbucket\API\Repositories\BranchRestrictions $restriction */
        $restriction    = $this->getApiMock('Bitbucket\API\Repositories\BranchRestrictions');
        $actual         = $restriction->get('gentle', 'eof', 1);

        $this->assertEquals($expectedResult, $actual);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/2.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('GET', $request->getMethod());
    }

    public function testUpdateRestrictionFromArray()
    {
        $endpoint       = 'repositories/gentle/eof/branch-restrictions/1';
        $params         = array(
            'users' => array(
                array('username' => 'vimishor'),
                array('username' => 'gtl_test1')
            )
        );

        /** @var \Bitbucket\API\Repositories\BranchRestrictions $restriction */
        $restriction = $this->getApiMock('Bitbucket\API\Repositories\BranchRestrictions');

        $restriction->update('gentle', 'eof', 1, $params);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/2.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('PUT', $request->getMethod());
        $this->assertSame(json_encode($params), $request->getBody()->getContents());
        $this->assertSame(['application/json'], $request->getHeader('Content-Type'));
    }

    public function testUpdateRestrictionFromJSON()
    {
        $endpoint       = 'repositories/gentle/eof/branch-restrictions/1';
        $params         = json_encode(array(
            'dummy' => array(
                array('username' => 'vimishor'),
                array('username' => 'gtl_test1')
            )
        ));

        /** @var \Bitbucket\API\Repositories\BranchRestrictions $restriction */
        $restriction = $this->getApiMock('Bitbucket\API\Repositories\BranchRestrictions');

        $restriction->update('gentle', 'eof', 1, $params);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/2.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('PUT', $request->getMethod());
        $this->assertSame($params, $request->getBody()->getContents());
        $this->assertSame(['application/json'], $request->getHeader('Content-Type'));
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testUpdateRestrictionWithInvalidParams()
    {
        /** @var \Bitbucket\API\Repositories\BranchRestrictions $restrictions */
        $restrictions   = $this->getApiMock('Bitbucket\API\Repositories\BranchRestrictions');

        $restrictions->update('gentle', 'eof', 1, '');
        $restrictions->update('gentle', 'eof', 1, 3);
        $restrictions->update('gentle', 'eof', 1, "{ 'foo': 'bar' }");
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testCreateRestrictionShouldFailIfKindIsSpecified()
    {
        $params         = array(
                'kind' => 'invalid'
            );

        $restrictions   = new \Bitbucket\API\Repositories\BranchRestrictions;

        $restrictions->update('gentle', 'eof', 1, $params);
    }

    public function testDeleteRestriction()
    {
        $endpoint       = 'repositories/gentle/eof/branch-restrictions/1';

        /** @var \Bitbucket\API\Repositories\BranchRestrictions $restriction */
        $restriction = $this->getApiMock('Bitbucket\API\Repositories\BranchRestrictions');

        $restriction->delete('gentle', 'eof', 1);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/2.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('DELETE', $request->getMethod());
    }
}
