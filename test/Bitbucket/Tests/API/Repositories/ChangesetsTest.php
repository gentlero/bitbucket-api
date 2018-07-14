<?php

namespace Bitbucket\Tests\API\Repositories;

use Bitbucket\Tests\API as Tests;
use Bitbucket\API;

class ChangesetsTest extends Tests\TestCase
{
    public function testGetAllChangesetsSuccess()
    {
        $endpoint       = 'repositories/gentle/eof/changesets';
        $expectedResult = $this->addFakeResponse(json_encode('dummy'));

        /** @var $changesets \Bitbucket\API\Repositories\Changesets */
        $changesets = $this->getApiMock('Bitbucket\API\Repositories\Changesets');

        $actual = $changesets->all('gentle', 'eof', 'aea95f1', 15);

        $this->assertEquals($expectedResult, $actual);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('start=aea95f1&limit=15&format=json', $request->getUri()->getQuery());
        $this->assertSame('GET', $request->getMethod());
    }

    public function testGetSpecificChangesetSuccess()
    {
        $endpoint       = 'repositories/gentle/eof/changesets/aea95f1';
        $expectedResult = $this->addFakeResponse(json_encode('dummy'));

        /** @var $changesets \Bitbucket\API\Repositories\Changesets */
        $changesets = $this->getApiMock('Bitbucket\API\Repositories\Changesets');

        $actual = $changesets->get('gentle', 'eof', 'aea95f1');

        $this->assertEquals($expectedResult, $actual);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('GET', $request->getMethod());
    }

    public function testGetChangesetDiffstatSuccess()
    {
        $endpoint       = 'repositories/gentle/eof/changesets/aea95f1/diffstat';
        $expectedResult = $this->addFakeResponse(json_encode('dummy'));

        /** @var $changesets \Bitbucket\API\Repositories\Changesets */
        $changesets = $this->getApiMock('Bitbucket\API\Repositories\Changesets');

        $actual = $changesets->diffstat('gentle', 'eof', 'aea95f1');

        $this->assertEquals($expectedResult, $actual);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('GET', $request->getMethod());
    }

    public function testGetChangesetDiffSuccess()
    {
        $endpoint       = 'repositories/gentle/eof/changesets/aea95f1/diff';
        $expectedResult = $this->addFakeResponse(json_encode('dummy'));

        /** @var $changesets \Bitbucket\API\Repositories\Changesets */
        $changesets = $this->getApiMock('Bitbucket\API\Repositories\Changesets');

        $actual = $changesets->diff('gentle', 'eof', 'aea95f1');

        $this->assertEquals($expectedResult, $actual);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('GET', $request->getMethod());
    }
}
