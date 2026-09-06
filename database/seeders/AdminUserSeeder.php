<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use RuntimeException;

class AdminUserSeeder extends Seeder
{
    private const EMAIL = 'admin@example.com';

    private const PASSWORD = 'Admin123!';

    public function run(): void
    {
        if (app()->isProduction()) {
            throw new RuntimeException('AdminUserSeeder hanya boleh dijalankan pada environment development atau testing.');
        }

        $user = User::where('email', self::EMAIL)->first();

        if ($user === null) {
            User::create([
                'name' => 'Administrator',
                'username' => 'admin',
                'email' => self::EMAIL,
                'password' => Hash::make(self::PASSWORD),
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
