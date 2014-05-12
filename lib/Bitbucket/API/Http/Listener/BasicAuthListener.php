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

use Buzz\Listener\BasicAuthListener as BaseListener;

/**
 * @author  Alexandru G.    <alex@gentle.ro>
 */
class BasicAuthListener extends BaseListener implements ListenerInterface
{
    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'basicauth';
    }
}
