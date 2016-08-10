<?php

namespace Bitbucket\Tests\API\Http\Listener;

use Bitbucket\API\Api;
use Bitbucket\API\Repositories;
use Bitbucket\Tests\API as Tests;
use Bitbucket\API\Http\Listener\OAuth2Listener;
use Buzz\Message\Response;

/**
 * @author  Alexandru G.    <alex@gentle.ro>
 */
class OAuth2ListenerTest extends Tests\TestCase
{
    /**
     * @expectedException \Bitbucket\API\Exceptions\ForbiddenAccessException
     */
    public function testGetAccessTokenShouldFailWithInvalidJson()
    {
        $oauth_params = array(
            'client_id'         => 'aaa',
            'client_secret'     => 'bbb'
        );

        $response = new Response();
        $response->setContent('{"bla": "boo}');

        $httpClient = $this->getHttpClientMock();
        $httpClient->expects($this->any())
            ->method('post')
            ->with(OAuth2Listener::ENDPOINT_ACCESS_TOKEN, array(
                'grant_type'    => 'client_credentials',
                'client_id'     => $oauth_params['client_id'],
                'client_secret' => $oauth_params['client_secret'],
                'scope'         => ''
            ))
            ->will($this->returnValue($response))
        ;

        $repositories = new Repositories(array(), $this->getHttpClient());
        $repositories->getClient()->addListener(
            new OAuth2Listener($oauth_params, $httpClient)
        );

        $repositories->all('my_account');
    }

    /**
     * @expectedException \Bitbucket\API\Exceptions\ForbiddenAccessException
     */
    public function testGetAccessTokenFail()
    {
        $oauth_params = array(
            'client_id'         => 'aaa',
            'client_secret'     => 'bbb'
        );

        $repositories = new Repositories(array(), $this->getHttpClient());
        $repositories->getClient()->addListener(
            new OAuth2Listener($oauth_params)
        );

        $repositories->all('my_account');
    }

    public function testOauth2ListenerDoesNotReplaceExistingBearer()
    {
        $oauth_params = array(
            'client_id'         => 'aaa',
            'client_secret'     => 'bbb'
        );

        $repositories = new Repositories(array(), $this->getHttpClient());
        $repositories->getClient()->addListener(
            new OAuth2Listener($oauth_params, $this->getHttpClient())
        );

        $repositories->getClient()->request('something', array(), 'GET', array(
            'Authorization' => 'Bearer secret'
        ));

        /** @var \Bitbucket\API\Http\Client $httpClient */
        $httpClient = $repositories->getClient();
        $authHeader = $httpClient->getLastRequest()->getHeader('Authorization');

        $this->assertContains('Bearer', $authHeader);
        $this->assertContains('secret', $authHeader);
    }

    public function testMakeSureRequestIncludesBearer()
    {
        $oauth_params = array(
            'client_id'         => 'aaa',
            'client_secret'     => 'bbb'
        );

        $response = new Response();
        $response->setContent(json_encode(array(
            'token_type' => 'Bearer',
            'access_token' => 'secret'
        )));

        $httpClient = $this->getHttpClientMock();
        $httpClient->expects($this->any())
            ->method('post')
            ->with(OAuth2Listener::ENDPOINT_ACCESS_TOKEN, array(
                'grant_type'    => 'client_credentials',
                'client_id'     => $oauth_params['client_id'],
                'client_secret' => $oauth_params['client_secret'],
                'scope'         => ''
            ))
            ->will($this->returnValue($response))
        ;

        $repositories = new Repositories(array(), $this->getHttpClient());
        $repositories->getClient()->addListener(
            new OAuth2Listener($oauth_params, $httpClient)
        );

        $repositories->all('my_account');

        /** @var \Bitbucket\API\Http\Client $httpClient */
        $httpClient = $repositories->getClient();
        $authHeader = $httpClient->getLastRequest()->getHeader('Authorization');

        $this->assertContains('Bearer', $authHeader);
        $this->assertContains('secret', $authHeader);
    }
}
