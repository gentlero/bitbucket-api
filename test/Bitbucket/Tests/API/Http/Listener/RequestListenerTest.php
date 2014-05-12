<?php

namespace Bitbucket\Tests\API\Http\Listener;

use Bitbucket\API\Http\Listener\RequestListener;
use Bitbucket\Tests\API as Tests;
use Buzz\Message\Request;

/**
 * @author  Alexandru G.    <alex@gentle.ro>
 */
class RequestListenerTest extends Tests\TestCase
{
    public function testPHPArrayToApiArrayConversion()
    {
        $listener   = new RequestListener();
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
}
