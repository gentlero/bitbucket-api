<?php

namespace Bitbucket\Tests\API\Repositories;

use Bitbucket\Tests\API as Tests;
use Bitbucket\API;

class RepositoryTest extends Tests\TestCase
{
    public function testGetRepository()
    {
        $endpoint       = 'repositories/gentle/eof';
        $expectedResult = $this->addFakeResponse(array('dummy'));

        /** @var \Bitbucket\API\Repositories\Repository $repo */
        $repo   = $this->getApiMock('Bitbucket\API\Repositories\Repository');
        $actual = $repo->get('gentle', 'eof');

        $this->assertEquals($expectedResult, $actual);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/2.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('GET', $request->getMethod());
    }

    /**
     * @return array of invalid value for repo creations parameter
     */
    public function invalidCreateProvider()
    {
        return array(
            array(''),
            array(3),
            array("\t"),
            array("\n"),
            array(' '),
            array("{ 'bar': 'baz' }"),
            array('{ repo: "company", }'),
            array('{ repo: "company" }'),
            array(
                substr(
                    "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ",
                    mt_rand(0, 50),
                    1
                ).substr(md5(time()), 1),
            ),
        );
    }

    /**
     * @param mixed $check
     * @expectedException \InvalidArgumentException
     * @dataProvider invalidCreateProvider
     * @ticket 27, 26
     */
    public function testInvalidCreate($check)
    {
        /** @var \Bitbucket\API\Repositories\Repository $repo */
        $repo = $this->getApiMock('Bitbucket\API\Repositories\Repository');
        $repo->create('gentle', 'new-repo', $check);

        $this->assertNull($this->mockClient->getLastRequest());
    }

    public function testCreateRepositoryFromJSON()
    {
        $endpoint       = 'repositories/gentle/new-repo';
        $params         = json_encode(array(
            'scm'               => 'git',
            'name'              => 'new-repo',
            'is_private'        => true,
            'description'       => 'My secret repo',
            'fork_policy'       => 'no_public_forks',
        ));

        /** @var \Bitbucket\API\Repositories\Repository $repo */
        $repo   = $this->getApiMock('Bitbucket\API\Repositories\Repository');

        $repo->create('gentle', 'new-repo', $params);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/2.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('POST', $request->getMethod());
        $this->assertSame($params, $request->getBody()->getContents());
    }

    public function testCreateRepositoryFromArray()
    {
        $endpoint       = 'repositories/gentle/new-repo';
        $params         = array(
            'scm'               => 'git',
            'name'              => 'new-repo',
            'is_private'        => true,
            'description'       => 'My secret repo',
            'fork_policy'       => 'no_public_forks',
        );

        /** @var \Bitbucket\API\Repositories\Repository $repo */
        $repo   = $this->getApiMock('Bitbucket\API\Repositories\Repository');

        $repo->create('gentle', 'new-repo', $params);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/2.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('POST', $request->getMethod());
        $this->assertSame(json_encode($params), $request->getBody()->getContents());
    }

    /**
     * @ticket 26
     */
    public function testCreateRepositoryWithDefaultParams()
    {
        $endpoint       = 'repositories/gentle/new-repo';
        $params         = array(
            'scm'               => 'git',
            'name'              => 'new-repo',
            'is_private'        => true,
            'description'       => 'My secret repo',
            'fork_policy'       => 'no_forks',
        );

        /** @var \Bitbucket\API\Repositories\Repository $repo */
        $repo   = $this->getApiMock('Bitbucket\API\Repositories\Repository');

        $repo->create('gentle', 'new-repo', array());

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/2.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('POST', $request->getMethod());
        $this->assertSame(json_encode($params), $request->getBody()->getContents());
    }

    public function testCreateRepositorySuccess()
    {
        $endpoint       = 'repositories';
        $params         = array(
            'name'          => 'secret',
            'description'   => 'My super secret project',
            'language'      => 'php',
            'is_private'    => true,
        );

        /** @var $repository \Bitbucket\API\Repositories\Repository */
        $repository = $this->getApiMock('Bitbucket\API\Repositories\Repository');

        $repository->create('secret', $params);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('POST', $request->getMethod());
        $this->assertSame(http_build_query($params), $request->getBody()->getContents());
    }

    public function testUpdateRepositorySuccess()
    {
        $endpoint       = 'repositories/gentle/eof';
        $params         = array(
            'description'   => 'My super secret project',
            'language'      => 'php',
            'is_private'    => false,
            'main_branch'   => 'master',
        );

        /** @var $repository \Bitbucket\API\Repositories\Repository */
        $repository = $this->getApiMock('Bitbucket\API\Repositories\Repository');

        $repository->update('gentle', 'eof', $params);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('PUT', $request->getMethod());
        $this->assertSame(http_build_query($params), $request->getBody()->getContents());
    }

    public function testDeleteRepository()
    {
        $endpoint       = 'repositories/gentle/eof';

        /** @var \Bitbucket\API\Repositories\Repository $repo */
        $repo   = $this->getApiMock('Bitbucket\API\Repositories\Repository');

        $repo->delete('gentle', 'eof');

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/2.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('DELETE', $request->getMethod());
    }

    public function testGetRepositoryWatchers()
    {
        $endpoint       = 'repositories/gentle/eof/watchers';
        $expectedResult = $this->addFakeResponse(array('dummy'));

        /** @var \Bitbucket\API\Repositories\Repository $repo */
        $repo   = $this->getApiMock('Bitbucket\API\Repositories\Repository');
        $actual = $repo->watchers('gentle', 'eof');

        $this->assertEquals($expectedResult, $actual);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/2.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('GET', $request->getMethod());
    }

    public function testGetRepositoryForks()
    {
        $endpoint       = 'repositories/gentle/eof/forks';
        $expectedResult = $this->addFakeResponse(array('dummy'));

        /** @var \Bitbucket\API\Repositories\Repository $repo */
        $repo   = $this->getApiMock('Bitbucket\API\Repositories\Repository');
        $actual = $repo->forks('gentle', 'eof');

        $this->assertEquals($expectedResult, $actual);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/2.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('GET', $request->getMethod());
    }

    public function testForkRepositorySuccess()
    {
        $endpoint       = 'repositories/gentle/eof/fork';

        /** @var $repository \Bitbucket\API\Repositories\Repository */
        $repository = $this->getApiMock('Bitbucket\API\Repositories\Repository');

        $repository->fork('gentle', 'eof', 'my-eof', array('is_private' => true));

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('POST', $request->getMethod());
        $this->assertSame('is_private=1&name=my-eof', $request->getBody()->getContents());
    }

    public function testGetBranches()
    {
        $endpoint       = 'repositories/gentle/eof/branches';
        $expectedResult = $this->addFakeResponse(json_encode('dummy'));

        /** @var $repository \Bitbucket\API\Repositories\Repository */
        $repository = $this->getApiMock('Bitbucket\API\Repositories\Repository');

        $actual = $repository->branches('gentle', 'eof');

        $this->assertEquals($expectedResult, $actual);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('GET', $request->getMethod());
    }

    public function testGetMainBranch()
    {
        $endpoint       = 'repositories/gentle/eof/main-branch';
        $expectedResult = $this->addFakeResponse(json_encode('dummy'));

        /** @var $repository \Bitbucket\API\Repositories\Repository */
        $repository = $this->getApiMock('Bitbucket\API\Repositories\Repository');

        $actual = $repository->branch('gentle', 'eof');

        $this->assertEquals($expectedResult, $actual);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('GET', $request->getMethod());
    }

    public function testGetManifest()
    {
        $endpoint       = 'repositories/gentle/eof/manifest/develop';
        $expectedResult = $this->addFakeResponse(json_encode('dummy'));

        /** @var $repository \Bitbucket\API\Repositories\Repository */
        $repository = $this->getApiMock('Bitbucket\API\Repositories\Repository');

        $actual = $repository->manifest('gentle', 'eof', 'develop');

        $this->assertEquals($expectedResult, $actual);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('GET', $request->getMethod());
    }

    public function testGetTags()
    {
        $endpoint       = 'repositories/gentle/eof/tags';
        $expectedResult = $this->addFakeResponse(json_encode('dummy'));

        /** @var $repository \Bitbucket\API\Repositories\Repository */
        $repository = $this->getApiMock('Bitbucket\API\Repositories\Repository');

        $actual = $repository->tags('gentle', 'eof');

        $this->assertEquals($expectedResult, $actual);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('GET', $request->getMethod());
    }

    public function testGetRawSource()
    {
        $endpoint       = 'repositories/gentle/eof/raw/1bc8345/lib/file.php';
        $expectedResult = $this->addFakeResponse(json_encode('dummy'));

        /** @var $repository \Bitbucket\API\Repositories\Repository */
        $repository = $this->getApiMock('Bitbucket\API\Repositories\Repository');

        $actual = $repository->raw('gentle', 'eof', '1bc8345', 'lib/file.php');

        $this->assertEquals($expectedResult, $actual);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('GET', $request->getMethod());
    }

    public function testGetFileHistory()
    {
        $endpoint       = 'repositories/gentle/eof/filehistory/1bc8345/lib/file.php';
        $expectedResult = $this->addFakeResponse(json_encode('dummy'));

        /** @var $repository \Bitbucket\API\Repositories\Repository */
        $repository = $this->getApiMock('Bitbucket\API\Repositories\Repository');

        $actual = $repository->filehistory('gentle', 'eof', '1bc8345', 'lib/file.php');

        $this->assertEquals($expectedResult, $actual);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('GET', $request->getMethod());
    }
}
