<?php

namespace abuterf\User\Tests\Unit;

use abouterf\User\Rules\ValidPassword;
use PHPUnit\Framework\TestCase;

class PasswordValidationTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_password_validation()
    {
        $result =(new ValidPassword())->passes('','789560');
        self::assertEquals(0,$result);
    }
}
