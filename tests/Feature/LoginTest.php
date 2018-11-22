<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_correct_responsse_after_user_logs_in()
    {
        $user = factory(User::class)->create();

        $this->postJson('/login', [
            'email' => $user->email,
            'password' => 'secret',
        ])
            ->assertStatus(200)
            ->assertJson([
                'status' => 'ok'
            ])
            ->assertSessionHas('success', 'Successfully logged in.');
    } 
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_a_user_receives_correct_message_when_passing_in_wrong_credentials()
    {
        $user = factory(User::class)->create();

        $this->postJson('/login', [
            'email' => $user->email,
            'password' => 'Wrong-password',
        ])
            ->assertStatus(422)
            ->assertJson([
                'message' => 'These credentials do not match our records.'
            ]);
    }
}
