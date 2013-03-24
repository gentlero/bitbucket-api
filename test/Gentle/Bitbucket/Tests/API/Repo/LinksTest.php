<?php

namespace Gentle\Bitbucket\Tests\API\Repo;

use Gentle\Bitbucket\Tests\API as Tests;
use Gentle\Bitbucket\API;

class LinksTest extends Tests\TestCase
{
    public function testGetAllLinks()
    {
        $endpoint       = 'repositories/gentle/eof/links';
        $expectedResult = json_encode('dummy');

        $links = $this->getApiMock('Gentle\Bitbucket\API\Repo\Links');
        $links->expects($this->once())
            ->method('requestGet')
            ->with($endpoint)
            ->will( $this->returnValue($expectedResult) );

        /** @var $links \Gentle\Bitbucket\API\Repo\Links */
        $actual = $links->all('gentle', 'eof');

        $this->assertEquals($expectedResult, $actual);
    }

    public function testGetSingleLink()
    {
        $endpoint       = 'repositories/gentle/eof/links/3';
        $expectedResult = json_encode('dummy');

        $links = $this->getApiMock('Gentle\Bitbucket\API\Repo\Links');
        $links->expects($this->once())
            ->method('requestGet')
            ->with($endpoint)
            ->will( $this->returnValue($expectedResult) );

        /** @var $links \Gentle\Bitbucket\API\Repo\Links */
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

        $link = $this->getApiMock('Gentle\Bitbucket\API\Repo\Links');
        $link->expects($this->once())
            ->method('requestPost')
            ->with($endpoint, $params);

        /** @var $link \Gentle\Bitbucket\API\Repo\Links */
        $link->create('gentle', 'eof', 'custom', 'https://example.com', 'my-project-key');
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testCreateLinkInvalidArguments()
    {
        $link = $this->getApiMock('Gentle\Bitbucket\API\Repo\Links');
        $link->expects($this->never())
            ->method('requestPost');

        /** @var $link \Gentle\Bitbucket\API\Repo\Links */
        $link->create('gentle', 'eof', 'invalid', 'https://example.com', 'my-project-key');
    }

    public function testUpdateLinkSuccess()
    {
        $endpoint       = 'repositories/gentle/eof/links/3';
        $params         = array(
            'link_url'  => 'https://example.com',
            'link_key'  => 'my-project-key'
        );

        $link = $this->getApiMock('Gentle\Bitbucket\API\Repo\Links');
        $link->expects($this->once())
            ->method('requestPut')
            ->with($endpoint, $params);

        /** @var $link \Gentle\Bitbucket\API\Repo\Links */
        $link->update('gentle', 'eof', 3, 'https://example.com', 'my-project-key');
    }

    public function testDeleteLinkSuccess()
    {
        $endpoint       = 'repositories/gentle/eof/links/3';

        $link = $this->getApiMock('Gentle\Bitbucket\API\Repo\Links');
        $link->expects($this->once())
            ->method('requestDelete')
            ->with($endpoint);

        /** @var $link \Gentle\Bitbucket\API\Repo\Issues\Links */
        $link->delete('gentle', 'eof', 3);
    }
}