<?php

namespace abuterf\User\Tests\Feature;

use abouterf\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ResetPasswordTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;


    public function test_user_can_see_reset_password_form_request()
    {
        $this->get(route('password.request'))->assertOk();
    }

    public function test_user_can_see_verify_code_form_by_correct_email()
    {
        $this->call('get', route('password.sendVerifyCodeEmail'),
            ['email' => 'ekargosha88@gmail.com'])->assertOk();
    }

    public function test_user_can_see_verify_code_form_by_wrong_email()
    {
        $this->call('get', route('password.sendVerifyCodeEmail'),
            ['email' => 'ekargoshagmail.com'])->assertRedirect();
    }

    public function test_user_banned_after_6_attempts()
    {
        for ($i = 0; $i < 5; $i++) {
            $this->post(route('password.checkVerifyCode'), ['verify_code', 'email' => 'ekar@mail.com'])->assertStatus(302);
        }
        $this->post(route('password.checkVerifyCode'), ['verify_code', 'email' => 'ekar@mail.com'])->assertStatus(429);

    }
}
