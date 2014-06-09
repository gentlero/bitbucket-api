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
 * Transform PHP array to API array
 *
 * PHP array square brackets does not play nice with remote API,
 * which expects just the key name, without brackets.
 *
 * Transforms: foo[0]=xxx&foo[1]=yyy" to "foo=xxx&foo=yyy"
 *
 * @author  Alexandru G.    <alex@gentle.ro>
 */
class NormalizeArrayListener implements ListenerInterface
{
    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'normalize_array';
    }

    /**
     * {@inheritDoc}
     */
    public function preSend(RequestInterface $request)
    {
        $request->setContent(
            // Transform: "foo[0]=xxx&foo[1]=yyy" to "foo=xxx&foo=yyy"
            preg_replace('/%5B(?:[0-9]|[1-9][0-9]+)%5D=/', '=', $request->getContent())
        );

        $request->setResource(
            // Transform: "foo[0]=xxx&foo[1]=yyy" to "foo=xxx&foo=yyy"
            preg_replace('/%5B(?:[0-9]|[1-9][0-9]+)%5D=/', '=', $request->getResource())
        );
    }

    /**
     * {@inheritDoc}
     */
    public function postSend(RequestInterface $request, MessageInterface $response)
    {
    }
}
