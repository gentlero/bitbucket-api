<?php

/**
 * This file is part of the bitbucket-api package.
 *
 * (c) Alexandru Guzinschi <alex@gentle.ro>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Bitbucket\Tests\API\Repositories;

use Bitbucket\Tests\API as Tests;
use Bitbucket\API;

class HooksTest extends Tests\TestCase
{
    public function invalidCreateProvider()
    {
        return array(
            array(array(
                'dummy'         => 'data',
            )),
            array(array(
                'description'   => 'My webhook',
                'url'           => '',
                'active'        => true,
            )),
            array(array(
                'description'   => 'My webhook',
                'url'           => '',
                'active'        => true,
                'events'        => array(),
            )),
            array(array(
                'description'   => 'My webhook',
                'url'           => '',
                'events'        => array(
                    'event1',
                    'event2',
                ),
            )),
            array(array(
                'description'   => 'My webhook',
                'active'        => true,
                'events'        => array(
                    'event1',
                    'event2',
                ),
                'extra'         => 'Allow user to specify custom data',
            )),
        );
    }

    /**
     * @access public
     * @param  mixed $check
     * @return void
     *
     * @expectedException \InvalidArgumentException
     * @dataProvider invalidCreateProvider
     */
    public function testInvalidCreate($check)
    {
        $client = $this->getHttpClientMock();

        /** @var \Bitbucket\API\Repositories\Hooks $hooks */
        $hooks = $this->getClassMock('Bitbucket\API\Repositories\Hooks', $client);
        $hooks->create('gentle', 'my-repo', $check);
    }

    public function testCreateSuccess()
    {
        $endpoint   = 'repositories/gentle/eof/hooks';
        $params     = array(
            'description'   => 'My first webhook',
            'url'           => 'http://requestb.in/xxx',
            'active'        => true,
            'events'        => array(
                'repo:push',
                'issue:created',
            ),
        );

        $client = $this->getHttpClientMock();
        $client->expects($this->any())
            ->method('post')
            ->with($endpoint, json_encode($params))
        ;

        /** @var \Bitbucket\API\Repositories\Hooks $hooks */
        $hooks = $this->getClassMock('Bitbucket\API\Repositories\Hooks', $client);
        $hooks->create('gentle', 'eof', $params);
    }

    public function testCreateSuccessWithExtraParameters()
    {
        $endpoint   = 'repositories/gentle/eof/hooks';
        $params     = array(
            'description'   => 'My first webhook',
            'url'           => 'http://requestb.in/xxx',
            'active'        => true,
            'extra'         => 'User can specify additional parameters',
            'events'        => array(
                'repo:push',
                'issue:created',
            ),
        );

        $client = $this->getHttpClientMock();
        $client->expects($this->any())
            ->method('post')
            ->with($endpoint, json_encode($params))
        ;

        /** @var \Bitbucket\API\Repositories\Hooks $hooks */
        $hooks = $this->getClassMock('Bitbucket\API\Repositories\Hooks', $client);
        $hooks->create('gentle', 'eof', $params);
    }

    public function testUpdateSuccess()
    {
        $endpoint   = 'repositories/gentle/eof/hooks/30b60aee-9cdf-407d-901c-2de106ee0c9d';
        $params     = array(
            'description'   => 'My first webhook',
            'url'           => 'http://requestb.in/zzz',
            'active'        => true,
            'events'        => array(
                'repo:push',
                'issue:created',
            ),
        );

        $client = $this->getHttpClientMock();
        $client->expects($this->any())
            ->method('put')
            ->with($endpoint, json_encode($params))
        ;

        /** @var \Bitbucket\API\Repositories\Hooks $hooks */
        $hooks = $this->getClassMock('Bitbucket\API\Repositories\Hooks', $client);
        $hooks->update('gentle', 'eof', '30b60aee-9cdf-407d-901c-2de106ee0c9d', $params);
    }

    /**
     * @access public
     * @param  mixed $check
     * @return void
     *
     * @expectedException \InvalidArgumentException
     * @dataProvider invalidCreateProvider
     */
    public function testInvalidUpdate($check)
    {
        $client = $this->getHttpClientMock();

        /** @var \Bitbucket\API\Repositories\Hooks $hooks */
        $hooks = $this->getClassMock('Bitbucket\API\Repositories\Hooks', $client);
        $hooks->update('gentle', 'eof', '30b60aee-9cdf-407d-901c-2de106ee0c9d', $check);
    }

    public function testGetAllHooks()
    {
        $endpoint       = 'repositories/gentle/eof/hooks';
        $expectedResult = $this->fakeResponse(array('dummy'));

        $client = $this->getHttpClientMock();
        $client->expects($this->any())
            ->method('get')
            ->with($endpoint)
            ->will($this->returnValue($expectedResult))
        ;

        /** @var \Bitbucket\API\Repositories\Hooks $hooks */
        $hooks  = $this->getClassMock('Bitbucket\API\Repositories\Hooks', $client);
        $actual = $hooks->all('gentle', 'eof');

        $this->assertEquals($expectedResult, $actual);
    }

    public function testGetSingleHook()
    {
        $endpoint       = 'repositories/gentle/eof/hooks/30b60aee-9cdf-407d-901c-2de106ee0c9d';
        $expectedResult = $this->fakeResponse(array('dummy'));

        $client = $this->getHttpClientMock();
        $client->expects($this->any())
            ->method('get')
            ->with($endpoint)
            ->will($this->returnValue($expectedResult))
        ;

        /** @var \Bitbucket\API\Repositories\Hooks $hooks */
        $hooks  = $this->getClassMock('Bitbucket\API\Repositories\Hooks', $client);
        $actual = $hooks->get('gentle', 'eof', '30b60aee-9cdf-407d-901c-2de106ee0c9d');

        $this->assertEquals($expectedResult, $actual);
    }

    public function testDeleteSingleHook()
    {
        $endpoint = 'repositories/gentle/eof/hooks/30b60aee-9cdf-407d-901c-2de106ee0c9d';

        $client = $this->getHttpClientMock();
        $client->expects($this->once())
            ->method('delete')
            ->with($endpoint);

        /** @var \Bitbucket\API\Repositories\Hooks $hooks */
        $hooks = $this->getClassMock('Bitbucket\API\Repositories\Hooks', $client);

        $hooks->delete('gentle', 'eof', '30b60aee-9cdf-407d-901c-2de106ee0c9d');
    }
}
