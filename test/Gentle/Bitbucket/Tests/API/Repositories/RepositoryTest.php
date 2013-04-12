<?php

namespace Gentle\Bitbucket\Tests\API\Repositories;

use Gentle\Bitbucket\Tests\API as Tests;
use Gentle\Bitbucket\API;

class RepositoryTest extends Tests\TestCase
{
    public function testCreateRepositorySuccess()
    {
        $endpoint       = 'repositories';
        $params         = array(
            'name'          => 'secret',
            'description'   => 'My super secret project',
            'language'      => 'php',
            'is_private'    => true
        );

        $repository = $this->getApiMock('Gentle\Bitbucket\API\Repositories\Repository');
        $repository->expects($this->once())
            ->method('requestPost')
            ->with($endpoint, $params);

        /** @var $repository \Gentle\Bitbucket\API\Repositories\Repository */
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

        $repository = $this->getApiMock('Gentle\Bitbucket\API\Repositories\Repository');
        $repository->expects($this->once())
            ->method('requestPut')
            ->with($endpoint, $params);

        /** @var $repository \Gentle\Bitbucket\API\Repositories\Repository */
        $repository->update('gentle', 'eof', $params);
    }
}