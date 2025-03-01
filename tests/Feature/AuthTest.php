<?php

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_register()
    {
        $response = $this->post('/register', [
            'name' => 'Testing User',
            'email' => 'testing@gmail.com',
            'password' => '12345678',
            'password_confirmation' => '12345678',
        ]);

        $response->assertRedirect('/dashboard'); // Pastikan redirect setelah sukses
        $this->assertDatabaseHas('users', ['email' => 'testing@gmail.com']);
    }

    public function test_user_can_login()
    {
        $user = User::factory()->create([
            'name' => 'Testing User',
            'email' => 'testing@gmail.com',
            'password' => bcrypt('12345678'),
        ]);

        $response = $this->post('/login', [
            'email' => 'testing@gmail.com',
            'password' => '12345678',
        ]);

        $response->assertRedirect('/dashboard'); // Pastikan redirect setelah login
        $this->assertAuthenticatedAs($user); // Pastikan user berhasil login
    }
}
