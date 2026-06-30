<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminAuthTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();

        // Create a default user for testing
        $this->user = User::create([
            'name' => 'Test User',
            'email' => 'admin@company.com',
            'password' => Hash::make('admin123'),
        ]);
    }

    /**
     * Test guest cannot access dashboard.
     */
    public function test_guest_cannot_access_dashboard(): void
    {
        $response = $this->get(route('admin.dashboard'));

        $response->assertRedirect(route('admin.login'));
        $response->assertSessionHas('error');
    }

    /**
     * Test guest can view login page.
     */
    public function test_guest_can_view_login_page(): void
    {
        $response = $this->get(route('admin.login'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.login');
    }

    /**
     * Test logged in user is redirected to dashboard when visiting login page.
     */
    public function test_logged_in_admin_redirected_to_dashboard_from_login_page(): void
    {
        $response = $this->withSession([
            'user_id' => $this->user->id,
            'user_name' => $this->user->name,
        ])->get(route('admin.login'));

        $response->assertRedirect(route('admin.dashboard'));
    }

    /**
     * Test validation error on empty fields.
     */
    public function test_login_validation(): void
    {
        $response = $this->post(route('admin.login.submit'), [
            'email' => '',
            'password' => '',
        ]);

        $response->assertSessionHasErrors(['email', 'password']);
    }

    /**
     * Test login failure with wrong credentials.
     */
    public function test_login_failure(): void
    {
        $response = $this->post(route('admin.login.submit'), [
            'email' => 'admin@company.com',
            'password' => 'wrongpassword',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('error', 'Email atau password salah.');
        $response->assertSessionMissing('user_id');
    }

    /**
     * Test login success with correct credentials.
     */
    public function test_login_success(): void
    {
        $response = $this->post(route('admin.login.submit'), [
            'email' => 'admin@company.com',
            'password' => 'admin123',
        ]);

        $response->assertRedirect(route('admin.dashboard'));
        $response->assertSessionHas('user_id', $this->user->id);
        $response->assertSessionHas('user_name', $this->user->name);
    }

    /**
     * Test logout clears session.
     */
    public function test_logout(): void
    {
        $response = $this->withSession([
            'user_id' => $this->user->id,
            'user_name' => $this->user->name,
        ])->post(route('admin.logout'));

        $response->assertRedirect(route('admin.login'));
        $response->assertSessionMissing('user_id');
        $response->assertSessionMissing('user_name');
    }
}
