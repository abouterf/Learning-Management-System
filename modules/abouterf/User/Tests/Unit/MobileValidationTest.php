<?php

namespace abuterf\User\Tests\Unit;

use abouterf\User\Rules\ValidMobile;
use PHPUnit\Framework\TestCase;

class MobileValidationTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_mobile_height()
    {
        $result = (new ValidMobile())->passes('','9123550569');
        $this->assertEquals(1,$result);
    }
}
