<?php

namespace Bitbucket\Tests\API\Http\Response;

use Bitbucket\Tests\API as Tests;
use Bitbucket\API\Repositories;
use Bitbucket\API\Http\Response\Pager;
use Buzz\Message\Response;

/**
 * @author Alexandru Guzinschi <alex@gentle.ro>
 */
class PagerTest extends Tests\TestCase
{
    public function testFetchNextSuccess()
    {
        $repo = $this->getRepositoriesMock(
            [
                'values' => array(),
                'next' => 'https://example.com/something?page=2'
            ],
            [
                'HTTP/1.1 200 OK'
            ]
        );

        $page = new Pager($this->getHttpClient(), $repo->all('gentle'));

        $this->assertTrue($page->hasNext());
        $this->assertInstanceOf('\Buzz\Message\Response', $page->fetchNext());
    }

    public function testFetchNextFail()
    {
        $repo = $this->getRepositoriesMock(
            [
                'values' => array()
            ],
            [
                'HTTP/1.1 200 OK'
            ]
        );

        $page = new Pager($this->getHttpClient(), $repo->all('gentle'));

        $this->assertFalse($page->hasNext());
        $this->assertNull($page->fetchNext());
    }

    public function testFetchPreviousSuccess()
    {
        $repo = $this->getRepositoriesMock(
            [
                'values' => array(),
                'previous' => 'https://example.com/something?page=2'
            ],
            [
                'HTTP/1.1 200 OK'
            ]
        );

        $page = new Pager($this->getHttpClient(), $repo->all('gentle'));

        $this->assertTrue($page->hasPrevious());
        $this->assertInstanceOf('\Buzz\Message\Response', $page->fetchPrevious());
    }

    public function testFetchPreviousFail()
    {
        $repo = $this->getRepositoriesMock(
            [
                'values' => array()
            ],
            [
                'HTTP/1.1 200 OK'
            ]
        );

        $page = new Pager($this->getHttpClient(), $repo->all('gentle'));

        $this->assertFalse($page->hasPrevious());
        $this->assertNull($page->fetchPrevious());
    }

    public function testFetchAllSuccess()
    {
        $expected = [
            'values' => [
                'dummy_1' => 'value_1',
                'dummy_2' => 'value_2',
                'dummy_3' => 'value_3'
            ]
        ];

        $headers = ['HTTP/1.1 200 OK'];
        $client = $this->getHttpClientMock();
        $client
            ->expects($this->any())
            ->method('get')
            ->will($this->onConsecutiveCalls(
                $this->getFakeResponse(['values' => ['dummy_1' => 'value_1'], 'next' => 'https://example.com/something?page=2'], $headers),
                $this->getFakeResponse(['values' => ['dummy_2' => 'value_2'], 'next' => 'https://example.com/something?page=3'], $headers),
                $this->getFakeResponse(['values' => ['dummy_3' => 'value_3']], $headers)
            ))
        ;

        $repo = new Repositories(array(), $client);
        $page = new Pager($client, $repo->all('gentle'));
        $response = $page->fetchAll();

        $this->assertInstanceOf('\Buzz\Message\Response', $response);
        $this->assertEquals($expected, json_decode($response->getContent(), true));
    }

    public function testFetchAllWithEmptyResponseShouldReturnEmptyValuesArray()
    {
        $expected = ['values' => []];
        $headers = ['HTTP/1.1 200 OK'];
        $client = $this->getHttpClientMock();
        $client
            ->expects($this->any())
            ->method('get')
            ->will($this->onConsecutiveCalls(
                $this->getFakeResponse([], $headers),
                $this->getFakeResponse([], $headers),
                $this->getFakeResponse([], $headers)
            ))
        ;

        $repo = new Repositories(array(), $client);
        $page = new Pager($client, $repo->all('gentle'));
        $response = $page->fetchAll();

        $this->assertInstanceOf('\Buzz\Message\Response', $response);
        $this->assertEquals($expected, json_decode($response->getContent(), true));
    }

    public function testFetchAllWithInvalidJsonShouldReturnEmptyValuesArray()
    {
        $expected = ['values' => []];
        $headers = ['HTTP/1.1 200 OK'];
        $response = new Response();
        $response->setContent('{"something": "yes"');
        $response->addHeaders($headers);

        $client = $this->getHttpClientMock();
        $client
            ->expects($this->any())
            ->method('get')
            ->will($this->returnValue($response))
        ;

        $repo = new Repositories(array(), $client);
        $page = new Pager($client, $repo->all('gentle'));
        $response = $page->fetchAll();

        $this->assertInstanceOf('\Buzz\Message\Response', $response);
        $this->assertEquals($expected, json_decode($response->getContent(), true));
    }

    /**
     * @expectedException \UnexpectedValueException
     */
    public function testFetchAllWithUnauthorizedHeaderShouldFail()
    {
        $headers = ['HTTP/1.1 401 Unauthorized'];
        $client = $this->getHttpClientMock();
        $client
            ->expects($this->any())
            ->method('get')
            ->will($this->onConsecutiveCalls(
                $this->getFakeResponse([], $headers),
                $this->getFakeResponse([], $headers),
                $this->getFakeResponse([], $headers)
            ))
        ;

        $repo = new Repositories(array(), $client);
        $page = new Pager($client, $repo->all('gentle'));
        $page->fetchAll();
    }

    public function testGetCurrentResponseSuccess()
    {
        $repo = $this->getRepositoriesMock(
            [
                'values' => array(),
                'previous' => 'https://example.com/something?page=2'
            ],
            [
                'HTTP/1.1 200 OK'
            ]
        );

        $page = new Pager($this->getHttpClient(), $repo->all('gentle'));
        $response = $page->getCurrent();

        $this->assertInstanceOf('\Buzz\Message\Response', $response);
    }

    /**
     * @expectedException \UnexpectedValueException
     */
    public function testGetCurrentResponseWithUnauthorizedHeaderShouldFail()
    {
        $repo = $this->getRepositoriesMock(
            [],
            [
                'HTTP/1.1 401 Unauthorized'
            ]
        );

        $page = new Pager($this->getHttpClient(), $repo->all('gentle'));
        $page->getCurrent();
    }

    private function getRepositoriesMock(array $results = array(), array $headers = array())
    {
        $expectedResult = $this->getFakeResponse($results, $headers);

        $client = $this->getHttpClientMock();
        $client->expects($this->any())
            ->method('get')
            ->will($this->returnValue($expectedResult));

        return new Repositories(array(), $client);
    }

    private function getFakeResponse(array $body, array $headers)
    {
        $expectedResult = $this->fakeResponse($body);
        $expectedResult->addHeaders($headers);

        return $expectedResult;
    }
}
