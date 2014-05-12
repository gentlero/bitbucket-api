<?php

/**
 * This file is part of the bitbucket-api package.
 *
 * (c) Alexandru G. <alex@gentle.ro>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Bitbucket\API;

/**
 * Allows repository administrators to send email invitations to
 * grant read, write, or admin privileges to a repository.
 *
 * @author  Alexandru G.    <alex@gentle.ro>
 */
class Invitations extends Api
{
    /**
     * Sending an invite
     *
     * @access public
     * @param  string $account    The team or individual account.
     * @param  string $repo       A repository belonging to the account.
     * @param  string $email      The email recipient.
     * @param  string $permission The permission the recipient is granted.
     * @return mixed
     */
    public function send($account, $repo, $email, $permission)
    {
        return $this->requestPost(
            sprintf('invitations/%s/%s/%s', $account, $repo, $email),
            array('permission' => $permission)
        );
    }
}
