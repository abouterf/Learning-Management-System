<?php


namespace abuterf\User\Tests\Unit;


use abouterf\User\Services\VerifyCodeService;
use Tests\TestCase;


class VerifyCodeServiceTest extends TestCase
{
    public function test_generated_code_is_6_digits()
    {
        $code = VerifyCodeService::generate();
        $this->assertIsNumeric($code,'is not numeric');
        $this->assertLessThanOrEqual(999999,$code,'less than 999999');
        $this->assertGreaterThanOrEqual(100000,$code,'greater than 999999');
    }

    public function test_verify_code_can_store()
    {
        $code = VerifyCodeService::generate();
        VerifyCodeService::store(1,$code);
        $this->assertEquals($code,cache()->get('verify_code_1'));
    }
}
