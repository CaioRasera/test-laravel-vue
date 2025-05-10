<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Admin
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'), 
            'is_admin' => true
        ]);

        // Usuário normal (leitor)
        User::create([
            'name' => 'Leitor',
            'email' => 'reader@example.com',
            'password' => Hash::make('password'), 
            'is_admin' => false
        ]);
    }
}