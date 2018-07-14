<?php

namespace Bitbucket\Tests\API\Repositories;

use Bitbucket\Tests\API as Tests;
use Bitbucket\API;

class InvitationsTest extends Tests\TestCase
{
    public function testSendInvitationSuccess()
    {
        $endpoint       = 'invitations/gentle/eof/john_doe@example.com';

        $invitation = $this->getApiMock('Bitbucket\API\Invitations');

        /** @var $invitation \Bitbucket\API\Invitations */
        $invitation->send('gentle', 'eof', 'john_doe@example.com', 'read');

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('POST', $request->getMethod());
        $this->assertSame('permission=read', $request->getBody()->getContents());
    }
}
