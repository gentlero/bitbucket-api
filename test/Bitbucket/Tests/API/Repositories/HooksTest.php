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
        /** @var \Bitbucket\API\Repositories\Hooks $hooks */
        $hooks = $this->getApiMock('Bitbucket\API\Repositories\Hooks');
        $hooks->create('gentle', 'my-repo', $check);

        $this->assertNull($this->mockClient->getLastRequest());
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

        /** @var \Bitbucket\API\Repositories\Hooks $hooks */
        $hooks = $this->getApiMock('Bitbucket\API\Repositories\Hooks');
        $hooks->create('gentle', 'eof', $params);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/2.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('POST', $request->getMethod());
        $this->assertSame(json_encode($params), $request->getBody()->getContents());
        $this->assertSame(['application/json'], $request->getHeader('Content-Type'));
    }

    /**
     * @ticket 72
     */
    public function testCreateIssue72()
    {
        $endpoint = 'repositories/gentle/eof/hooks';

        $params     = array(
            'description'   => 'My first webhook',
            'url'           => 'http://requestb.in/xxx',
            'active'        => true,
            'events'        => array(
                'repo:push',
                'issue:created',
            )
        );

        /** @var \Bitbucket\API\Repositories\Hooks $hooks */
        $hooks = $this->getApiMock('Bitbucket\API\Repositories\Hooks');
        $response = $hooks->create('gentle', 'eof', $params);

        $this->assertInstanceOf('Psr\Http\Message\MessageInterface', $response);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/2.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('POST', $request->getMethod());
        $this->assertSame(json_encode($params), $request->getBody()->getContents());
        $this->assertSame(['application/json'], $request->getHeader('Content-Type'));
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

        /** @var \Bitbucket\API\Repositories\Hooks $hooks */
        $hooks = $this->getApiMock('Bitbucket\API\Repositories\Hooks');
        $hooks->create('gentle', 'eof', $params);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/2.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('POST', $request->getMethod());
        $this->assertSame(json_encode($params), $request->getBody()->getContents());
        $this->assertSame(['application/json'], $request->getHeader('Content-Type'));
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

        /** @var \Bitbucket\API\Repositories\Hooks $hooks */
        $hooks = $this->getApiMock('Bitbucket\API\Repositories\Hooks');
        $hooks->update('gentle', 'eof', '30b60aee-9cdf-407d-901c-2de106ee0c9d', $params);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/2.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('PUT', $request->getMethod());
        $this->assertSame(json_encode($params), $request->getBody()->getContents());
        $this->assertSame(['application/json'], $request->getHeader('Content-Type'));
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
        /** @var \Bitbucket\API\Repositories\Hooks $hooks */
        $hooks = $this->getApiMock('Bitbucket\API\Repositories\Hooks');
        $hooks->update('gentle', 'eof', '30b60aee-9cdf-407d-901c-2de106ee0c9d', $check);

        $this->assertNull($this->mockClient->getLastRequest());
    }

    public function testGetAllHooks()
    {
        $endpoint       = 'repositories/gentle/eof/hooks';
        $expectedResult = $this->addFakeResponse(array('dummy'));

        /** @var \Bitbucket\API\Repositories\Hooks $hooks */
        $hooks  = $this->getApiMock('Bitbucket\API\Repositories\Hooks');
        $actual = $hooks->all('gentle', 'eof');

        $this->assertEquals($expectedResult, $actual);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/2.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('GET', $request->getMethod());
    }

    public function testGetSingleHook()
    {
        $endpoint       = 'repositories/gentle/eof/hooks/30b60aee-9cdf-407d-901c-2de106ee0c9d';
        $expectedResult = $this->addFakeResponse(array('dummy'));

        /** @var \Bitbucket\API\Repositories\Hooks $hooks */
        $hooks  = $this->getApiMock('Bitbucket\API\Repositories\Hooks');
        $actual = $hooks->get('gentle', 'eof', '30b60aee-9cdf-407d-901c-2de106ee0c9d');

        $this->assertEquals($expectedResult, $actual);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/2.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('GET', $request->getMethod());
    }

    public function testDeleteSingleHook()
    {
        $endpoint = 'repositories/gentle/eof/hooks/30b60aee-9cdf-407d-901c-2de106ee0c9d';

        /** @var \Bitbucket\API\Repositories\Hooks $hooks */
        $hooks = $this->getApiMock('Bitbucket\API\Repositories\Hooks');

        $hooks->delete('gentle', 'eof', '30b60aee-9cdf-407d-901c-2de106ee0c9d');

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/2.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('DELETE', $request->getMethod());
    }
}
