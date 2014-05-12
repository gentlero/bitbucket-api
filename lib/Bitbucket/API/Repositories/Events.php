<?php

/**
 * This file is part of the bitbucket-api package.
 *
 * (c) Alexandru G. <alex@gentle.ro>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Bitbucket\API\Repositories;

use Bitbucket\API;

/**
 * You can use events to track events that occur on public repositories.
 * NOTE: Tracking events from private repositories are not supported for
 * the moment by the API.
 *
 * @author  Alexandru G.    <alex@gentle.ro>
 */
class Events extends API\Api
{
    /**
     * Get a list of events
     *
     * Available `$options`:
     *
     * <example>
     * 'start'  (int) = An integer specifying the offset to start with. By default, this call starts with 0.
     * 'limit'  (int) = An integer specifying the number of events to return. (0 - 50 range)
     * 'type'   (string) = The event type to return.
     * </example>
     *
     * @access public
     * @param  string $account The team or individual account owning the repository.
     * @param  string $repo    The repository identifier.
     * @param  array  $options The rest of available options
     * @return mixed
     *
     * @see https://confluence.atlassian.com/display/BITBUCKET/events+Resources#eventsResources-GETalistofevents
     */
    public function all($account, $repo, $options = array())
    {
        return $this->requestGet(
            sprintf('repositories/%s/%s/events', $account, $repo),
            $options
        );
    }
}
