<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\AdminUserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Tests\TestCase;

class AdminAuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_login_page_can_be_rendered(): void
    {
        $response = $this->get(route('admin.login'));

        $response->assertOk()->assertSee('Selamat Datang Kembali');
    }

    public function test_guest_is_redirected_to_admin_login_from_dashboard(): void
    {
        $response = $this->get(route('admin.dashboard'));

        $response->assertRedirect(route('admin.login'));
    }

    public function test_authenticated_user_can_view_dashboard(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('admin.dashboard'));

        $response->assertOk()->assertSee('Selamat datang, '.$user->name);
    }

    public function test_authenticated_user_is_redirected_from_login_to_dashboard(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('admin.login'));

        $response->assertRedirect(route('admin.dashboard'));
    }

    public function test_active_user_can_login_with_email_and_password(): void
    {
        $user = User::factory()->create([
            'email' => 'editor@example.com',
            'password' => Hash::make('secret-password'),
        ]);

        $response = $this->post(route('admin.login.store'), [
            'email' => $user->email,
            'password' => 'secret-password',
            'remember' => true,
        ]);

        $response->assertRedirect(route('admin.dashboard'));
        $this->assertAuthenticatedAs($user);
        $this->assertDatabaseHas('audit_logs', ['user_id' => $user->id, 'action' => 'admin.login']);
    }

    public function test_invalid_credentials_are_rejected_with_generic_message(): void
    {
        $user = User::factory()->create(['email' => 'editor@example.com']);

        $response = $this->from(route('admin.login'))->post(route('admin.login.store'), [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        $response->assertRedirect(route('admin.login'))
            ->assertSessionHasErrors(['email' => 'Email atau password tidak valid.']);
        $this->assertGuest();
    }

    public function test_inactive_user_cannot_login_and_has_no_authenticated_session(): void
    {
        $user = User::factory()->create([
            'email' => 'inactive@example.com',
            'password' => Hash::make('secret-password'),
            'status' => 'inactive',
        ]);

        $response = $this->from(route('admin.login'))->post(route('admin.login.store'), [
            'email' => $user->email,
            'password' => 'secret-password',
        ]);

        $response->assertRedirect(route('admin.login'))
            ->assertSessionHasErrors(['email' => 'Akun tidak dapat digunakan untuk masuk.']);
        $this->assertGuest();
    }

    public function test_repeated_failed_login_attempts_are_rate_limited(): void
    {
        RateLimiter::clear('editor@example.com|127.0.0.1');

        for ($attempt = 0; $attempt < 5; $attempt++) {
            $this->post(route('admin.login.store'), [
                'email' => 'editor@example.com',
                'password' => 'wrong-password',
            ]);
        }

        $response = $this->from(route('admin.login'))->post(route('admin.login.store'), [
            'email' => 'editor@example.com',
            'password' => 'wrong-password',
        ]);

        $response->assertRedirect(route('admin.login'))
            ->assertSessionHasErrors('email');
        $this->assertStringContainsString('Terlalu banyak', session('errors')->get('email')[0]);
    }

    public function test_authenticated_user_can_logout(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('admin.logout'));

        $response->assertRedirect(route('admin.login'));
        $this->assertGuest();
        $this->assertDatabaseHas('audit_logs', ['user_id' => $user->id, 'action' => 'admin.logout']);
    }

    public function test_admin_seeder_is_idempotent_and_hashes_password(): void
    {
        $this->seed(AdminUserSeeder::class);
        $this->seed(AdminUserSeeder::class);

        $admin = User::where('email', 'admin@example.com')->firstOrFail();

        $this->assertSame(1, User::where('email', 'admin@example.com')->count());
        $this->assertSame('active', $admin->status);
        $this->assertTrue(Hash::check('Admin123!', $admin->password));
    }
}
