<?php

namespace Bitbucket\Tests\API;

use Bitbucket\Tests\API as Tests;
use Bitbucket\API;

class GroupsTest extends Tests\TestCase
{
    public function testGetAllGroups()
    {
        $endpoint       = 'groups/gentle/';
        $expectedResult = $this->addFakeResponse(json_encode('dummy'));

        /** @var $groups \Bitbucket\API\Groups */
        $groups = $this->getApiMock('Bitbucket\API\Groups');
        $actual = $groups->get('gentle');

        $this->assertEquals($expectedResult, $actual);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('GET', $request->getMethod());
    }

    public function testGetAllGroupsWithFilters()
    {
        $endpoint       = 'groups';
        $expectedResult = $this->addFakeResponse('x');

        /** @var $groups \Bitbucket\API\Groups */
        $groups = $this->getApiMock('\Bitbucket\API\Groups');
        $actual = $groups->get('gentle', array('group' => array('gentle/testers', 'gentle/maintainers')));

        $this->assertEquals($expectedResult, $actual);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('GET', $request->getMethod());
    }

    public function testCreateGroupSuccess()
    {
        $endpoint       = 'groups/gentle/';

        $groups = $this->getApiMock('Bitbucket\API\Groups');

        /** @var $groups \Bitbucket\API\Groups */
        $groups->create('gentle', 'testers');

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('POST', $request->getMethod());
        $this->assertSame('name=testers', $request->getBody()->getContents());
    }

    public function testUpdateGroupSuccess()
    {
        $endpoint       = 'groups/gentle/dummy/';
        $params         = array(
            'accountname'   => 'gentle',
            'name'          => 'Dummy group'
        );

        $group = $this->getApiMock('Bitbucket\API\Groups');


        /** @var $group \Bitbucket\API\Groups */
        $group->update('gentle', 'dummy', $params);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('PUT', $request->getMethod());
        $this->assertSame('accountname=gentle&name=Dummy+group', $request->getBody()->getContents());
    }

    public function testDeleteGroupSuccess()
    {
        $endpoint       = 'groups/gentle/dummy/';

        $groups = $this->getApiMock('Bitbucket\API\Groups');

        /** @var $groups \Bitbucket\API\Groups */
        $groups->delete('gentle', 'dummy');

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('DELETE', $request->getMethod());
    }
}
