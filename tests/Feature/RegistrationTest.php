<?php

namespace Tests\Feature;

use App\Mail\ConfirmYourEmail;
use App\User;
use Mail;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
    //    public function testExample()
    //    {
    //        $this->assertTrue(true);
    //    }


//    public function test_a_user_has_a_default_username_after_regiistration()
//    {
//
//    }

    public function test_a_user_has_a_token_after_registration()
    {
        Mail::fake();
        $this->withoutExceptionHandling();

        $this->post('/register', [
            'name' => 'Hayhs',
            'email' => 'hais@gmail.com',
            'confirm_token' => str_random(25),
            'password' => 'secret',
            'password_confirmation' => 'secret'
        ])->assertRedirect();

        $user = User::find(1);
        $this->assertNotNull($user->confirm_token);
        $this->assertFalse($user->isConfirmed() );
    }

    public function test_an_email_is_sent_to_newly_registered_users()
    {
        Mail::fake();
        $this->withoutExceptionHandling();

        $this->post('/register', [
            'name' => 'Haykokalipsis',
            'email' => 'haykojgkis@gmail.com',
//            'confirm_token' => str_random(25),
            'password' => 'secret',
            'password_confirmation' => 'secret'
        ])->assertRedirect();

        Mail::assertSent(ConfirmYourEmail::class);
    }
}
