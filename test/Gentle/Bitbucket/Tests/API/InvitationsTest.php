<?php

namespace Gentle\Bitbucket\Tests\API\Repositories;

use Gentle\Bitbucket\Tests\API as Tests;
use Gentle\Bitbucket\API;

class InvitationsTest extends Tests\TestCase
{
    public function testSendInvitationSuccess()
    {
        $endpoint       = 'invitations/gentle/eof/john_doe@example.com';
        $params         = array('permission' => 'read');

        $invitation = $this->getApiMock('Gentle\Bitbucket\API\Invitations');
        $invitation->expects($this->once())
            ->method('requestPost')
            ->with($endpoint, $params);

        /** @var $invitation \Gentle\Bitbucket\API\Invitations */
        $invitation->send('gentle', 'eof', 'john_doe@example.com', 'read');
    }
}