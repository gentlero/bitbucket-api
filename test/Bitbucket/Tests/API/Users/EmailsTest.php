<?php

namespace Bitbucket\Tests\API\Users;

use Bitbucket\Tests\API as Tests;

class EmailsTest extends Tests\TestCase
{
    public function testGetAllEmails()
    {
        $endpoint       = 'users/gentle/emails';
        $expectedResult = $this->addFakeResponse(json_encode('dummy'));

        /** @var $emails \Bitbucket\API\Users\Emails */
        $emails = $this->getApiMock('Bitbucket\API\Users\Emails');

        $actual = $emails->all('gentle');

        $this->assertEquals($expectedResult, $actual);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('GET', $request->getMethod());
    }

    public function testGetSingleEmail()
    {
        $endpoint       = 'users/gentle/emails/dummy@example.com';
        $expectedResult = $this->addFakeResponse(json_encode('dummy'));

        /** @var $emails \Bitbucket\API\Users\Emails */
        $emails = $this->getApiMock('Bitbucket\API\Users\Emails');

        $actual = $emails->get('gentle', 'dummy@example.com');

        $this->assertEquals($expectedResult, $actual);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('GET', $request->getMethod());
    }

    public function testAddNewEmailSuccess()
    {
        $endpoint   = 'users/gentle/emails/dummy@example.com';

        /** @var $email \Bitbucket\API\Users\Emails */
        $email = $this->getApiMock('\Bitbucket\API\Users\Emails');

        $email->create('gentle', 'dummy@example.com');

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('POST', $request->getMethod());
    }

    public function testUpdateEmailSuccess()
    {
        $endpoint   = 'users/gentle/emails/dummy@example.com';

        /** @var $email \Bitbucket\API\Users\Emails */
        $email = $this->getApiMock('\Bitbucket\API\Users\Emails');

        $email->update('gentle', 'dummy@example.com', true);

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('PUT', $request->getMethod());
        $this->assertSame('primary=1', $request->getBody()->getContents());
    }

    public function testDeleteEmailSuccess()
    {
        $endpoint   = 'users/gentle/emails/dummy@example.com';

        $email = $this->getApiMock('\Bitbucket\API\Users\Emails');

        /** @var $email \Bitbucket\API\Users\Emails */
        $email->delete('gentle', 'dummy@example.com');

        $request = $this->mockClient->getLastRequest();

        $this->assertSame('/1.0/' . $endpoint, $request->getUri()->getPath());
        $this->assertSame('DELETE', $request->getMethod());
    }
}
