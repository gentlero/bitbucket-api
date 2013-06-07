<?php

namespace Bitbucket\Tests\API\Users;

use Bitbucket\Tests\API as Tests;
use Bitbucket\API;

class EmailsTest extends Tests\TestCase
{
    public function testGetAllEmails()
    {
        $endpoint       = 'users/gentle/emails';
        $expectedResult = json_encode('dummy');

        $emails = $this->getApiMock('Bitbucket\API\Users\Emails');
        $emails->expects($this->once())
            ->method('requestGet')
            ->with($endpoint)
            ->will( $this->returnValue($expectedResult) );

        /** @var $emails \Bitbucket\API\Users\Emails */
        $actual = $emails->all('gentle');

        $this->assertEquals($expectedResult, $actual);
    }

    public function testGetSingleEmail()
    {
        $endpoint       = 'users/gentle/emails/dummy@example.com';
        $expectedResult = json_encode('dummy');

        $emails = $this->getApiMock('Bitbucket\API\Users\Emails');
        $emails->expects($this->once())
            ->method('requestGet')
            ->with($endpoint)
            ->will( $this->returnValue($expectedResult) );

        /** @var $emails \Bitbucket\API\Users\Emails */
        $actual = $emails->get('gentle', 'dummy@example.com');

        $this->assertEquals($expectedResult, $actual);
    }

    public function testUpdateUserSuccess()
    {
        $endpoint   = 'users/gentle/emails/dummy@example.com';

        $email = $this->getApiMock('\Bitbucket\API\Users\Emails');
        $email->expects($this->once())
            ->method('requestPost')
            ->with($endpoint);

        /** @var $email \Bitbucket\API\Users\Emails */
        $email->create('gentle', 'dummy@example.com');
    }
}