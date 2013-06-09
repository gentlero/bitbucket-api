<?php

namespace Bitbucket\Tests\API\Authentication;

use Bitbucket\Tests\API as Tests;
use Bitbucket\API\Authentication;

class ExceptionTest extends Tests\TestCase
{
    /**
     * @expectedException Exception
     */
    public function testException()
    {
        throw new Authentication\Exception();
    }
}
