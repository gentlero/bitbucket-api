<?php

namespace Bitbucket\Tests\API\Repositories;

use Bitbucket\Tests\API as Tests;
use Bitbucket\API;

class RepositoryTest extends Tests\TestCase
{
    public function testGetRepository()
    {
        $endpoint       = 'repositories/gentle/eof';
        $expectedResult = $this->fakeResponse(array('dummy'));

        $client = $this->getHttpClientMock();
        $client->expects($this->once())
            ->method('get')
            ->with($endpoint)
            ->will($this->returnValue($expectedResult));

        /** @var \Bitbucket\API\Repositories\Repository $repo */
        $repo   = $this->getClassMock('Bitbucket\API\Repositories\Repository', $client);
        $actual = $repo->get('gentle', 'eof');

        $this->assertEquals($expectedResult, $actual);
    }

    public function testCreateRepositoryFromJSON()
    {
        $endpoint       = 'repositories/gentle/new-repo';
        $params         = json_encode(array(
            'scm'               => 'git',
            'name'              => 'new-repo',
            'is_private'        => true,
            'description'       => 'My secret repo',
            'forking_policy'    => 'no_public_forks',
        ));

        $client = $this->getHttpClientMock();
        $client->expects($this->once())
            ->method('post')
            ->with($endpoint, $params);

        /** @var \Bitbucket\API\Repositories\Repository $repo */
        $repo   = $this->getClassMock('Bitbucket\API\Repositories\Repository', $client);

        $repo->create('gentle', 'new-repo', $params);
    }

    public function testCreateRepositoryFromArray()
    {
        $endpoint       = 'repositories/gentle/new-repo';
        $params         = array(
            'scm'               => 'git',
            'name'              => 'new-repo',
            'is_private'        => true,
            'description'       => 'My secret repo',
            'forking_policy'    => 'no_public_forks',
        );

        $client = $this->getHttpClientMock();
        $client->expects($this->once())
            ->method('post')
            ->with($endpoint, json_encode($params));

        /** @var \Bitbucket\API\Repositories\Repository $repo */
        $repo   = $this->getClassMock('Bitbucket\API\Repositories\Repository', $client);

        $repo->create('gentle', 'new-repo', $params);
    }

    public function testCreateRepositorySuccess()
    {
        $endpoint       = 'repositories';
        $params         = array(
            'name'          => 'secret',
            'description'   => 'My super secret project',
            'language'      => 'php',
            'is_private'    => true
        );

        $repository = $this->getApiMock('Bitbucket\API\Repositories\Repository');
        $repository->expects($this->once())
            ->method('requestPost')
            ->with($endpoint, $params);

        /** @var $repository \Bitbucket\API\Repositories\Repository */
        $repository->create('secret', $params);
    }

    public function testUpdateRepositorySuccess()
    {
        $endpoint       = 'repositories/gentle/eof';
        $params         = array(
            'description'   => 'My super secret project',
            'language'      => 'php',
            'is_private'    => false,
            'main_branch'   => 'master'
        );

        $repository = $this->getApiMock('Bitbucket\API\Repositories\Repository');
        $repository->expects($this->once())
            ->method('requestPut')
            ->with($endpoint, $params);

        /** @var $repository \Bitbucket\API\Repositories\Repository */
        $repository->update('gentle', 'eof', $params);
    }

    public function testDeleteRepository()
    {
        $endpoint       = 'repositories/gentle/eof';

        $client = $this->getHttpClientMock();
        $client->expects($this->once())
            ->method('delete')
            ->with($endpoint);

        /** @var \Bitbucket\API\Repositories\Repository $repo */
        $repo   = $this->getClassMock('Bitbucket\API\Repositories\Repository', $client);

        $repo->delete('gentle', 'eof');
    }

    public function testGetRepositoryWatchers()
    {
        $endpoint       = 'repositories/gentle/eof/watchers';
        $expectedResult = $this->fakeResponse(array('dummy'));

        $client = $this->getHttpClientMock();
        $client->expects($this->once())
            ->method('get')
            ->with($endpoint)
            ->will($this->returnValue($expectedResult));

        /** @var \Bitbucket\API\Repositories\Repository $repo */
        $repo   = $this->getClassMock('Bitbucket\API\Repositories\Repository', $client);
        $actual = $repo->watchers('gentle', 'eof');

        $this->assertEquals($expectedResult, $actual);
    }

    public function testGetRepositoryForks()
    {
        $endpoint       = 'repositories/gentle/eof/forks';
        $expectedResult = $this->fakeResponse(array('dummy'));

        $client = $this->getHttpClientMock();
        $client->expects($this->once())
            ->method('get')
            ->with($endpoint)
            ->will($this->returnValue($expectedResult));

        /** @var \Bitbucket\API\Repositories\Repository $repo */
        $repo   = $this->getClassMock('Bitbucket\API\Repositories\Repository', $client);
        $actual = $repo->forks('gentle', 'eof');

        $this->assertEquals($expectedResult, $actual);
    }

    public function testForkRepositorySuccess()
    {
        $endpoint       = 'repositories/gentle/eof/fork';
        $params         = array(
            'name'          => 'my-eof',
            'is_private'    => true
        );

        $repository = $this->getApiMock('Bitbucket\API\Repositories\Repository');
        $repository->expects($this->once())
            ->method('requestPost')
            ->with($endpoint, $params);

        /** @var $repository \Bitbucket\API\Repositories\Repository */
        $repository->fork('gentle', 'eof', 'my-eof', array('is_private' => true));
    }

    public function testGetBranches()
    {
        $endpoint       = 'repositories/gentle/eof/branches';
        $expectedResult = json_encode('dummy');

        $repository = $this->getApiMock('Bitbucket\API\Repositories\Repository');
        $repository->expects($this->once())
            ->method('requestGet')
            ->with($endpoint)
            ->will( $this->returnValue($expectedResult) );

        /** @var $repository \Bitbucket\API\Repositories\Repository */
        $actual = $repository->branches('gentle', 'eof');

        $this->assertEquals($expectedResult, $actual);
    }

    public function testGetMainBranch()
    {
        $endpoint       = 'repositories/gentle/eof/main-branch';
        $expectedResult = json_encode('dummy');

        $repository = $this->getApiMock('Bitbucket\API\Repositories\Repository');
        $repository->expects($this->once())
            ->method('requestGet')
            ->with($endpoint)
            ->will( $this->returnValue($expectedResult) );

        /** @var $repository \Bitbucket\API\Repositories\Repository */
        $actual = $repository->branch('gentle', 'eof');

        $this->assertEquals($expectedResult, $actual);
    }

    public function testGetManifest()
    {
        $endpoint       = 'repositories/gentle/eof/manifest/develop';
        $expectedResult = json_encode('dummy');

        $repository = $this->getApiMock('Bitbucket\API\Repositories\Repository');
        $repository->expects($this->once())
            ->method('requestGet')
            ->with($endpoint)
            ->will( $this->returnValue($expectedResult) );

        /** @var $repository \Bitbucket\API\Repositories\Repository */
        $actual = $repository->manifest('gentle', 'eof', 'develop');

        $this->assertEquals($expectedResult, $actual);
    }

    public function testGetTags()
    {
        $endpoint       = 'repositories/gentle/eof/tags';
        $expectedResult = json_encode('dummy');

        $repository = $this->getApiMock('Bitbucket\API\Repositories\Repository');
        $repository->expects($this->once())
            ->method('requestGet')
            ->with($endpoint)
            ->will( $this->returnValue($expectedResult) );

        /** @var $repository \Bitbucket\API\Repositories\Repository */
        $actual = $repository->tags('gentle', 'eof');

        $this->assertEquals($expectedResult, $actual);
    }

    public function testGetRawSource()
    {
        $endpoint       = 'repositories/gentle/eof/raw/1bc8345/lib/file.php';
        $expectedResult = json_encode('dummy');

        $repository = $this->getApiMock('Bitbucket\API\Repositories\Repository');
        $repository->expects($this->once())
            ->method('requestGet')
            ->with($endpoint)
            ->will( $this->returnValue($expectedResult) );

        /** @var $repository \Bitbucket\API\Repositories\Repository */
        $actual = $repository->raw('gentle', 'eof', '1bc8345', 'lib/file.php');

        $this->assertEquals($expectedResult, $actual);
    }

    public function testGetFileHistory()
    {
        $endpoint       = 'repositories/gentle/eof/filehistory/1bc8345/lib/file.php';
        $expectedResult = json_encode('dummy');

        $repository = $this->getApiMock('Bitbucket\API\Repositories\Repository');
        $repository->expects($this->once())
            ->method('requestGet')
            ->with($endpoint)
            ->will( $this->returnValue($expectedResult) );

        /** @var $repository \Bitbucket\API\Repositories\Repository */
        $actual = $repository->filehistory('gentle', 'eof', '1bc8345', 'lib/file.php');

        $this->assertEquals($expectedResult, $actual);
    }
}
