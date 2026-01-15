<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // ADMIN
        User::updateOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name'     => 'Admin',
                'password' => Hash::make('123456'),
                'is_admin' => true,
            ]
        );

        // USUÁRIO NORMAL
        User::updateOrCreate(
            ['email' => 'teste@teste.com'],
            [
                'name'     => 'Teste',
                'password' => Hash::make('123456'),
                'is_admin' => false,
            ]
        );
    }
}
