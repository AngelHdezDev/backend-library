<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Crear un usuario super administrador
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'), 
            'role' => 'superAdmin', 
        ]);

        // Crear un usuario bibliotecario
        User::create([
            'name' => 'Bibliothecary',
            'email' => 'bibliotecario@example.com',
            'password' => Hash::make('password'),
            'role' => 'bibliothecary',
        ]);

        // Crear un usuario normal

        User::create([
            'name' => 'User',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);
    }
}
