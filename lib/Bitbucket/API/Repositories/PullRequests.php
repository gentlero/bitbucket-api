<?php

/*
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
 * PullRequests class
 *
 * Manage the comments on pull requests.
 *
 * @author  Alexandru G.    <alex@gentle.ro>
 */
class PullRequests extends API\Api
{
    /**
     * Get comments
     *
     * @access public
     * @return PullRequests\Comments
     * @codeCoverageIgnore
     */
    public function comments()
    {
        $comments = new PullRequests\Comments( $this->client );

        if ( !is_null($this->auth)) {
            $comments->setCredentials( $this->auth );
        }

        return $comments;
    }
}
