<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminAuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_login_page_is_available_to_guests(): void
    {
        $this->get('/admin/login')
            ->assertOk()
            ->assertSee('Welcome back')
            ->assertSee('Host &amp; Operations Console', false);
    }

    public function test_admin_can_sign_in_and_access_dashboard(): void
    {
        $admin = User::factory()->admin()->create([
            'password' => 'a-secure-admin-password',
        ]);

        $this->post('/admin/login', [
            'email' => $admin->email,
            'password' => 'a-secure-admin-password',
        ])->assertRedirect(route('admin.dashboard'));

        $this->assertAuthenticatedAs($admin);
        $this->get('/admin')->assertOk()->assertSee($admin->name);
    }

    public function test_regular_user_cannot_sign_in_to_admin_console(): void
    {
        $user = User::factory()->create([
            'password' => 'a-secure-user-password',
        ]);

        $this->post('/admin/login', [
            'email' => $user->email,
            'password' => 'a-secure-user-password',
        ])->assertSessionHasErrors('email');

        $this->assertGuest();
    }

    public function test_dashboard_requires_authentication(): void
    {
        $this->get('/admin')->assertRedirect(route('login'));
    }

    public function test_admin_can_sign_out(): void
    {
        $admin = User::factory()->admin()->create();

        $this->actingAs($admin)
            ->post('/admin/logout')
            ->assertRedirect(route('login'));

        $this->assertGuest();
    }
}
