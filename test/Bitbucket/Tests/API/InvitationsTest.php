<?php

namespace Bitbucket\Tests\API\Repositories;

use Bitbucket\Tests\API as Tests;
use Bitbucket\API;

class InvitationsTest extends Tests\TestCase
{
    public function testSendInvitationSuccess()
    {
        $endpoint       = 'invitations/gentle/eof/john_doe@example.com';
        $params         = array('permission' => 'read');

        $invitation = $this->getApiMock('Bitbucket\API\Invitations');
        $invitation->expects($this->once())
            ->method('requestPost')
            ->with($endpoint, $params);

        /** @var $invitation \Bitbucket\API\Invitations */
        $invitation->send('gentle', 'eof', 'john_doe@example.com', 'read');
    }
}