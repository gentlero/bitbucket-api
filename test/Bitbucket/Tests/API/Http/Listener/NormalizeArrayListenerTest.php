<?php

namespace Bitbucket\Tests\API\Http\Listener;

use Bitbucket\API\Http\Listener\NormalizeArrayListener;
use Bitbucket\Tests\API as Tests;
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
}
