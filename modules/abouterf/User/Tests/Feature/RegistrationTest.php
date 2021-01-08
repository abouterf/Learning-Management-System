<?php

namespace abuterf\User\Tests\Feature;

use abouterf\User\Models\User;
use abouterf\User\Services\VerifyCodeService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    //runs per method


    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_can_see_register_form()
    {
        $response = $this->get(route('register'));
        $response->assertStatus(200);
    }

    public function test_user_can_register()
    {
        $this->withoutExceptionHandling();
        $response = $this->registerNewUser();
        $response->assertRedirect(route('home'));
        $this->assertCount(1, User::all());
    }

    public function test_user_have_to_verify()
    {
        $response = $this->registerNewUser();
        $response = $this->get(route('home'));
        $response->assertRedirect(route('verification.notice'));
    }

    public function test_user_can_verify_account()
    {
        $user = User::create([
            'name' => $this->faker->name,
            'email' => $this->faker->safeEmail,
            'password' => bcrypt('A!123a')
        ]);
        $code = VerifyCodeService::generate();
        VerifyCodeService::store($user->id, $code, now()->addDay());
        auth()->loginUsingId($user->id);
        $this->assertAuthenticated();
        $this->post(route('verification.verify'), [
            'verify_code' => $code
        ]);
        $this->assertEquals(true, $user->fresh()->hasVerifiedEmail());
    }

    public function test_verified_user_can_see_home_page()
    {
        $response = $this->registerNewUser();
        $this->assertAuthenticated();
        auth()->user()->markEmailAsVerified();
        $response = $this->get(route('home'));
        $response->assertOk();
    }

    /**
     * @return \Illuminate\Testing\TestResponse
     */
    public function registerNewUser()
    {
        $response = $this->post(
            route('register'),
            [
                'name' => 'Erfan',
                'email' => 'erfan@mail.com',
                'mobile' => '9364568585',
                'password' => 'Ek0930160883@',
                'password_confirmation' => 'Ek0930160883@'
            ]
        );
        return $response;
    }
}
