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

use Buzz\Listener\ListenerInterface as BaseInterface;

/**
 * @author  Alexandru G.    <alex@gentle.ro>
 */
interface ListenerInterface extends BaseInterface
{
    /**
     * Get listener (unique) name
     *
     * @access public
     * @return string
     */
    public function getName();
}
