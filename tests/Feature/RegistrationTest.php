<?php

namespace Tests\Feature;

use App\Mail\ConfirmYourEmail;
use Mail;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegistrationTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
//    public function testExample()
//    {
//        $this->assertTrue(true);
//    }


public function test_an_email_is_sent_to_newly_registered_users()
{
    $this->withoutExceptionHandling();
    Mail::fake();

    $this->post('/register', [
        'name' => 'Haykokalipsis',
        'email' => 'haykokalipssis@gmail.com',
        'password' => 'secret',
        'password_confirmation' => 'secret'
    ])->assertRedirect();

    Mail::assertSent(ConfirmYourEmail::class);
} 
}
