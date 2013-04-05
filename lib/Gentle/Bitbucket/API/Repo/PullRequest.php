<?php

/*
 * This file is part of the bitbucket-api package.
 *
 * (c) Alexandru G. <alex@gentle.ro>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gentle\Bitbucket\API\Repo;

use Gentle\Bitbucket\API;

/**
 * PullRequest class
 *
 * Manage the comments on pull requests.
 *
 * @author  Alexandru G.    <alex@gentle.ro>
 */
class PullRequest extends API\Api
{
    /**
     * Get comments
     *
     * @access public
     * @return PullRequest\Comments
     * @codeCoverageIgnore
     */
    public function comments()
    {
        $comments = new PullRequest\Comments( $this->client );

        if ( !is_null($this->auth)) {
            $comments->setCredentials( $this->auth );
        }

        return $comments;
    }
}
