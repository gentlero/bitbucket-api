<?php

namespace Bitbucket\Tests\API\Repositories;

use Bitbucket\Tests\API as Tests;
use Bitbucket\API;

class LinksTest extends Tests\TestCase
{
    public function testGetAllLinks()
    {
        $endpoint       = 'repositories/gentle/eof/links';
        $expectedResult = json_encode('dummy');

        $links = $this->getApiMock('Bitbucket\API\Repositories\Links');
        $links->expects($this->once())
            ->method('requestGet')
            ->with($endpoint)
            ->will( $this->returnValue($expectedResult) );

        /** @var $links \Bitbucket\API\Repositories\Links */
        $actual = $links->all('gentle', 'eof');

        $this->assertEquals($expectedResult, $actual);
    }

    public function testGetSingleLink()
    {
        $endpoint       = 'repositories/gentle/eof/links/3';
        $expectedResult = json_encode('dummy');

        $links = $this->getApiMock('Bitbucket\API\Repositories\Links');
        $links->expects($this->once())
            ->method('requestGet')
            ->with($endpoint)
            ->will( $this->returnValue($expectedResult) );

        /** @var $links \Bitbucket\API\Repositories\Links */
        $actual = $links->get('gentle', 'eof', 3);

        $this->assertEquals($expectedResult, $actual);
    }

    public function testCreateLinkSuccess()
    {
        $endpoint       = 'repositories/gentle/eof/links';
        $params         = array(
            'handler'   => 'custom',
            'link_url'  => 'https://example.com',
            'link_key'  => 'my-project-key'
        );

        $link = $this->getApiMock('Bitbucket\API\Repositories\Links');
        $link->expects($this->once())
            ->method('requestPost')
            ->with($endpoint, $params);

        /** @var $link \Bitbucket\API\Repositories\Links */
        $link->create('gentle', 'eof', 'custom', 'https://example.com', 'my-project-key');
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testCreateLinkInvalidArguments()
    {
        $link = $this->getApiMock('Bitbucket\API\Repositories\Links');
        $link->expects($this->never())
            ->method('requestPost');

        /** @var $link \Bitbucket\API\Repositories\Links */
        $link->create('gentle', 'eof', 'invalid', 'https://example.com', 'my-project-key');
    }

    public function testUpdateLinkSuccess()
    {
        $endpoint       = 'repositories/gentle/eof/links/3';
        $params         = array(
            'link_url'  => 'https://example.com',
            'link_key'  => 'my-project-key'
        );

        $link = $this->getApiMock('Bitbucket\API\Repositories\Links');
        $link->expects($this->once())
            ->method('requestPut')
            ->with($endpoint, $params);

        /** @var $link \Bitbucket\API\Repositories\Links */
        $link->update('gentle', 'eof', 3, 'https://example.com', 'my-project-key');
    }

    public function testDeleteLinkSuccess()
    {
        $endpoint       = 'repositories/gentle/eof/links/3';

        $link = $this->getApiMock('Bitbucket\API\Repositories\Links');
        $link->expects($this->once())
            ->method('requestDelete')
            ->with($endpoint);

        /** @var $link \Bitbucket\API\Repositories\Issues\Links */
        $link->delete('gentle', 'eof', 3);
    }
}