<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('123456'),
        ]);

        // Você pode criar mais usuários aqui
        User::create([
            'name' => 'Teste',
            'email' => 'teste@teste.com',
            'password' => Hash::make('123456'),
        ]);
    }
}