<?php

namespace Bitbucket\Tests\API\Http\Response;

use Bitbucket\Tests\API as Tests;
use Bitbucket\API\Repositories;
use Bitbucket\API\Http\Response\Pager;

/**
 * @author Alexandru Guzinschi <alex@gentle.ro>
 */
class PagerTest extends Tests\TestCase
{
    public function testFetchNextSuccess()
    {
        $response = $this->addFakeResponse(json_encode([
            'values' => array(),
            'next' => 'https://example.com/something?page=2'
        ]));

        $page = new Pager($this->getHttpPluginClientBuilder(), $response);

        $this->assertTrue($page->hasNext());
        $this->assertInstanceOf('\Psr\Http\Message\ResponseInterface', $page->fetchNext());
    }

    public function testFetchNextFail()
    {
        $response = $this->addFakeResponse(json_encode([
            'values' => array(),
        ]));

        $page = new Pager($this->getHttpPluginClientBuilder(), $response);

        $this->assertFalse($page->hasNext());
        $this->assertNull($page->fetchNext());
    }

    public function testFetchPreviousSuccess()
    {
        $response = $this->addFakeResponse(json_encode([
            'values' => array(),
            'previous' => 'https://example.com/something?page=2'
        ]));

        $page = new Pager($this->getHttpPluginClientBuilder(), $response);

        $this->assertTrue($page->hasPrevious());
        $this->assertInstanceOf('\Psr\Http\Message\ResponseInterface', $page->fetchPrevious());
    }

    public function testFetchPreviousFail()
    {
        $response = $this->addFakeResponse(json_encode([
            'values' => array(),
        ]));

        $page = new Pager($this->getHttpPluginClientBuilder(), $response);

        $this->assertFalse($page->hasPrevious());
        $this->assertNull($page->fetchPrevious());
    }

    public function testFetchAllSuccess()
    {
        $response = $this->addFakeResponse(json_encode(
            ['values' => ['dummy_1' => 'value_1'], 'next' => 'https://example.com/something?page=2']
        ));
        $this->addFakeResponse(json_encode(
            ['values' => ['dummy_2' => 'value_2'], 'next' => 'https://example.com/something?page=3']
        ));
        $this->addFakeResponse(json_encode(['values' => ['dummy_3' => 'value_3']]));

        $expected = [
            'values' => [
                'dummy_1' => 'value_1',
                'dummy_2' => 'value_2',
                'dummy_3' => 'value_3'
            ]
        ];

        $page = new Pager($this->getHttpPluginClientBuilder(), $response);
        $response = $page->fetchAll();

        $this->assertInstanceOf('\Psr\Http\Message\ResponseInterface', $response);
        $this->assertEquals($expected, json_decode($response->getBody()->getContents(), true));
    }

    public function testFetchAllWithEmptyResponseShouldReturnEmptyValuesArray()
    {
        $response = $this->addFakeResponse(json_encode(['values' => []]));
        $this->addFakeResponse(json_encode(['values' => []]));
        $this->addFakeResponse(json_encode(['values' => []]));

        $page = new Pager($this->getHttpPluginClientBuilder(), $response);
        $response = $page->fetchAll();

        $this->assertInstanceOf('\Psr\Http\Message\ResponseInterface', $response);
        $this->assertEquals(['values' => []], json_decode($response->getBody()->getContents(), true));
    }

    public function testFetchAllWithInvalidJsonShouldReturnEmptyValuesArray()
    {
        $expected = ['values' => []];
        $response = $this->addFakeResponse('{"something": "yes"');

        $page = new Pager($this->getHttpPluginClientBuilder(), $response);
        $response = $page->fetchAll();

        $this->assertInstanceOf('\Psr\Http\Message\ResponseInterface', $response);
        $this->assertEquals($expected, json_decode($response->getBody()->getContents(), true));
    }

    /**
     * @expectedException \UnexpectedValueException
     */
    public function testFetchAllWithUnauthorizedHeaderShouldFail()
    {
        $response = $this->addFakeResponse([], 401);

        new Pager($this->getHttpPluginClientBuilder(), $response);
    }

    public function testGetCurrentResponseSuccess()
    {
        $response = $this->addFakeResponse(json_encode([
            'values' => array(),
            'previous' => 'https://example.com/something?page=2'
        ]));

        $page = new Pager($this->getHttpPluginClientBuilder(), $response);
        $response = $page->getCurrent();

        $this->assertInstanceOf('\Psr\Http\Message\ResponseInterface', $response);
    }
}
