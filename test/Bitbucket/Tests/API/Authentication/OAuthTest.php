<?php

namespace Bitbucket\Tests\API\Authentication;

use Bitbucket\Tests\API as Tests;
use Bitbucket\API\Authentication;
use Buzz\Message\Request;

class OAuthTest extends Tests\TestCase
{
    public function testGetSetAuthHeader()
    {
        // from string
        $auth = new Authentication\OAuth('Authorization: dummy');
        $this->assertEquals('dummy', $auth->getAuthHeader());

        // from array
        $auth->setAuthHeader($this->getArrayParams());
        $this->assertEquals($this->getStringParams(), $auth->getAuthHeader());
    }

    public function testAuthenticateFromArraySuccess()
    {
        $params     = $this->getArrayParams();
        $auth       = new Authentication\OAuth($params);
        $request    = new Request();

        $auth->authenticate($request);

        // check if header is set
        $header = $request->getHeader('Authorization');
        $this->assertNotEmpty($header);

        // check if header was built correctly
        $this->assertEquals('OAuth '.$this->getStringParams(), $header);
    }

    public function testAuthenticateFromStringSuccess()
    {
        $params     = $this->getStringParams();
        $auth       = new Authentication\OAuth($params);
        $request    = new Request();

        $auth->authenticate($request);

        // check if header is set
        $header = $request->getHeader('Authorization');
        $this->assertNotEmpty($header);

        // check if header was built correctly
        $this->assertEquals('OAuth '.$params, $header);
    }

    private function getArrayParams()
    {
        return array(
            'oauth_version'             => '1.0',
            'oauth_nonce'               => 'aaaaaaaaaaaaaaa',
            'oauth_timestamp'           => '1370771799',
            'oauth_consumer_key'        => 'xxxxxxxxxxxxxxx',
            'oauth_signature_method'    => 'HMAC-SHA1',
            'oauth_signature'           => 'yyyyyyyyyyyyyyy'
        );
    }

    private function getStringParams()
    {
        return 'oauth_version="1.0",oauth_nonce="aaaaaaaaaaaaaaa",oauth_timestamp="1370771799",oauth_consumer_key="xxxxxxxxxxxxxxx",oauth_signature_method="HMAC-SHA1",oauth_signature="yyyyyyyyyyyyyyy"';
    }
}