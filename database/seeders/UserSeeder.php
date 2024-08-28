<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $superAdminRole = Role::firstOrCreate(['name' => 'superAdmin']);
        $bibliothecaryRole = Role::firstOrCreate(['name' => 'bibliothecary']);
        $userRole = Role::firstOrCreate(['name' => 'user']);

        // Crear un usuario super administrador
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'), 
            'role' => 'superAdmin', 
        ]);
        $admin->assignRole($superAdminRole);

        // Crear un usuario bibliotecario
        $bibliothecary = User::create([
            'name' => 'Bibliothecary',
            'email' => 'bibliotecario@example.com',
            'password' => Hash::make('password'),
            'role' => 'bibliothecary',
        ]);
        $bibliothecary->assignRole($bibliothecaryRole);

        // Crear un usuario normal

        $user = User::create([
            'name' => 'User',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);
        $user->assignRole($userRole);
    }
}
