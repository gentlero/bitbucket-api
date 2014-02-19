<?php

/**
 * This file is part of the bitbucket-api package.
 *
 * (c) Alexandru G. <alex@gentle.ro>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Bitbucket\API\Http\Listener;

use Buzz\Message\MessageInterface;
use Buzz\Message\RequestInterface;

/**
 * @author  Alexandru G.    <alex@gentle.ro>
 */
class OAuthListener implements ListenerInterface
{
    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'oauth';
    }

    /**
     * {@inheritDoc}
     */
    public function preSend(RequestInterface $request)
    {}

    /**
     * {@inheritDoc}
     */
    public function postSend(RequestInterface $request, MessageInterface $response)
    {}
} 
