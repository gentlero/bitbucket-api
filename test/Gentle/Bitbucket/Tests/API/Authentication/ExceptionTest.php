<?php

namespace Gentle\Bitbucket\Tests\API\Authentication;

use Gentle\Bitbucket\Tests\API as Tests;
use Gentle\Bitbucket\API\Authentication;

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
