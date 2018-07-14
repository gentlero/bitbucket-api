<?php

namespace Bitbucket\Tests\API\Http\Listener;

use Bitbucket\API\Api;
use Bitbucket\API\Http\Listener\NormalizeArrayListener;
use Bitbucket\Tests\API as Tests;
use Buzz\Message\Form\FormRequest;
use Buzz\Message\Request;

/**
 * @author  Alexandru G.    <alex@gentle.ro>
 */
class NormalizeArrayListenerTest extends Tests\TestCase
{
    public function testPHPArrayToApiArrayConversion()
    {
        $listener   = new NormalizeArrayListener();
        $request    = new Request('POST', '/dummy');

        $request->setContent(
            http_build_query(
                array(
                    'branch' => 'master',
                    'exclude' => array(
                        'aaa',
                        'ccc'
                    ),
                    'include' => array(
                        'bbb'
                    )
                )
            )
        );

        $listener->preSend($request);

        $this->assertEquals('branch=master&exclude=aaa&exclude=ccc&include=bbb', $request->getContent());
    }

    /**
     * @ticket 62
     */
    public function testShouldNotRunOnFormData()
    {
        $api            = $this->getApiMock("Bitbucket\API\Api");
        $this->assertInstanceOf('\Bitbucket\API\Api', $api);

        $api->getClient()
            ->setApiVersion('2.0')
        ;

        $headers = array('Content-Type' => 'multipart/form-data');
        $request = new FormRequest();
        $request->setField('issue_id', 4);
        $request->setHeaders($headers);
        $api->getClient()->setRequest($request);

        $this->assertTrue($api->getClient()->isListener('normalize_array'));

        $response = $api->getClient()->request(
            sprintf('repositories/%s/%s/issues/%d/attachments', 'gentlero', 'eof', 4),
            array(),
            'POST',
            $headers
        );

        $this->assertInstanceOf('\Buzz\Message\MessageInterface', $response);
    }
}
