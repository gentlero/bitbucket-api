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
     * @var BuzzClientInterface
     */
    protected $client;

    public function __construct(BuzzClientInterface $client = null)
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
}
