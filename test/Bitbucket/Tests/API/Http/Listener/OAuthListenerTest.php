<?php

namespace Bitbucket\Tests\API\Http\Listener;

use Bitbucket\Tests\API as Tests;
use Bitbucket\API\Http\Listener\OAuthListener;
use Bitbucket\API\Http\Client;

/**
 * @author  Alexandru G.    <alex@gentle.ro>
 */
class OAuthListenerTest extends Tests\TestCase
{
    public function testInvalidSignatureShouldFallbackToHmacSha1()
    {
        $oauth      = new OAuthListener(array('oauth_signature_method' => 'dummy'));
        $reflection = new \ReflectionClass($oauth);
        $property   = $reflection->getProperty('signature');

        $property->setAccessible(true);

        $this->assertInstanceOf('JacobKiers\OAuth\SignatureMethod\HmacSha1', $property->getValue($oauth));
    }

    public function testTokenInstantiateForOneLegged()
    {
        $oauth = new OAuthListener(array(
            'oauth_consumer_key'    => 'aaa',
            'oauth_consumer_secret' => 'bbb'
        ));

        $reflection = new \ReflectionClass($oauth);
        $property   = $reflection->getProperty('token');

        $property->setAccessible(true);

        $this->assertInstanceOf('JacobKiers\OAuth\Token\NullToken', $property->getValue($oauth));
    }

    public function testTokenInstantiateforThreeLegged()
    {
        $oauth = new OAuthListener(array(
            'oauth_consumer_key'        => 'aaa',
            'oauth_consumer_secret'     => 'bbb',
            'oauth_token'               => 'ccc',
            'oauth_token_secret'        => 'ddd'
        ));

        $reflection = new \ReflectionClass($oauth);
        $property   = $reflection->getProperty('token');

        $property->setAccessible(true);

        $this->assertInstanceOf('JacobKiers\OAuth\Token\Token', $property->getValue($oauth));
    }

    public function testFilterOAuthParameters()
    {
        $method = $this->getMethod('\Bitbucket\API\Http\Listener\OAuthListener', 'filterOAuthParameters');
        $actual = $method->invokeArgs(new OAuthListener(array()),  array(array('invalid_option', 'oauth_version')));

        $this->assertArrayHasKey('oauth_version', $actual);
        $this->assertArrayNotHasKey('invalid_option', $actual);
    }

    public function testMakeSureRequestIncludesOAuthHeader()
    {
        $oauth_params = array(
            'oauth_consumer_key'      => 'aaa',
            'oauth_consumer_secret'   => 'bbb'
        );
        $listener   = new OAuthListener($oauth_params);
        $bb         = new \Bitbucket\API\Api($this->getBrowserMock());

        $bb->getClient()->addListener($listener);

        $bb->requestGet('/dummy');

        $auth_header = $bb->getClient()->getLastRequest()->getHeader('Authorization');

        $this->assertContains('OAuth', $auth_header);
        $this->assertContains(
            sprintf('oauth_consumer_key="%s"', $oauth_params['oauth_consumer_key']),
            $auth_header
        );
    }
} 
