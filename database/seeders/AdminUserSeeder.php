<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use RuntimeException;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        if (app()->isProduction()) {
            throw new RuntimeException('AdminUserSeeder hanya boleh dijalankan pada environment development atau testing.');
        }

        $email = (string) config('admin.email');
        $password = (string) config('admin.password');

        if ($password === '') {
            throw new RuntimeException('ADMIN_PASSWORD wajib diisi sebelum menjalankan AdminUserSeeder.');
        }

        $user = User::where('email', $email)->first();

        if ($user === null) {
            User::create([
                'name' => 'Administrator',
                'username' => 'admin',
                'email' => $email,
                'password' => Hash::make($password),
                'status' => 'active',
                'email_verified_at' => now(),
            ]);

            return;
        }

        if ($user->status !== 'active') {
            $user->update(['status' => 'active']);
        }
    }
}
