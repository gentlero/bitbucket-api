<?php

/**
 * This file is part of the bitbucket-api package.
 *
 * (c) Alexandru G. <alex@gentle.ro>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Bitbucket\API\Http;

use Buzz\Client\ClientInterface as BuzzClientInterface;
use Buzz\Client\Curl;

/**
 * @author  Alexandru G.    <alex@gentle.ro>
 */
class Client
{
    /**
     * @var array
     */
    protected $options = array(
        'base_url'      => 'https://api.bitbucket.org',
        'api_version'   => '1.0',
        'api_versions'  => array('1.0', '2.0'),     // supported versions
        'format'        => 'json',
        'formats'       => array('json', 'xml'),    // supported response formats
        'user_agent'    => 'bitbucket-api-php/0.1.2 (https://bitbucket.org/gentlero/bitbucket-api)',
    );

    /**
     * @var BuzzClientInterface
     */
    protected $client;

    public function __construct(array $options = array(), BuzzClientInterface $client = null)
    {
        $this->client = (is_null($client)) ? new Curl : $client;
    }

    /**
     * @access public
     * @return BuzzClientInterface
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @access public
     * @return string
     */
    public function getResponseFormat()
    {
        return $this->options['format'];
    }

    /**
     * @access public
     * @param  string $format
     * @return $this
     *
     * @throws \InvalidArgumentException
     */
    public function setResponseFormat($format)
    {
        if (!in_array($format, $this->options['formats'])) {
            throw new \InvalidArgumentException(sprintf('Unsupported response format %s', $format));
        }

        $this->options['format'] = $format;

        return $this;
    }

    /**
     * Get API version currently used
     *
     * @access public
     * @return mixed
     */
    public function getApiVersion()
    {
        return $this->options['api_version'];
    }

    /**
     * Change used API version for next request
     *
     * @access public
     * @param  float $version
     * @return $this
     *
     * @throws \InvalidArgumentException
     */
    public function setApiVersion($version)
    {
        if (!in_array($version, $this->options['api_versions'])) {
            throw new \InvalidArgumentException(sprintf('Unsupported API version %s', $version));
        }

        $this->options['api_version'] = $version;

        return $this;
    }

    /**
     * @return string
     */
    public function getApiBaseUrl()
    {
        return $this->options['base_url'].'/'.$this->getApiVersion();
    }
}
