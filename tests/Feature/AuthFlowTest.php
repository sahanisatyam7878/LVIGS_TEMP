<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthFlowTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        if (! extension_loaded('pdo_sqlite')) {
            $this->markTestSkipped('The pdo_sqlite extension is required for database-backed auth tests.');
        }

        parent::setUp();
    }

    public function test_user_can_register_with_phone_number(): void
    {
        $this->post('/register', [
            'name' => 'Test User',
            'email' => 'user@example.com',
            'phone' => '9876543210',
            'password' => 'secret123',
            'password_confirmation' => 'secret123',
        ])->assertRedirect('/login');

        $this->assertDatabaseHas('users', [
            'email' => 'user@example.com',
            'phone' => '9876543210',
        ]);
    }

    public function test_user_can_login_with_phone_number(): void
    {
        User::factory()->create([
            'phone' => '9876543210',
            'password' => 'secret123',
        ]);

        $this->post('/login', [
            'login' => '9876543210',
            'password' => 'secret123',
        ])->assertRedirect('/dashboard');

        $this->assertAuthenticated();
    }
}
