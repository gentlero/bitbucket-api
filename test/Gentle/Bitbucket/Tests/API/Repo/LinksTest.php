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
}