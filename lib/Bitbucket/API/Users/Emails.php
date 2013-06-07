<?php

/*
 * This file is part of the bitbucket_api package.
 *
 * (c) Alexandru G. <alex@gentle.ro>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Bitbucket\API\Users;

use Bitbucket\API\Api;

/**
 * Emails class
 *
 * List, change, or create an email address.
 *
 * @author  Alexandru G.    <alex@gentle.ro>
 */
class Emails extends Api
{
    /**
     * Get a list of user's email addresses
     *
     * @access public
     * @param  string $account The name of an individual or team account.
     * @return mixed
     */
    public function all($account)
    {
        return $this->requestGet(
            sprintf('users/%s/emails', $account)
        );
    }
}
