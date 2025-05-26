<?php

// database/seeders/RoleSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run()
    {
        // Crear roles
        Role::firstOrCreate(['name' => 'admin']);
        Role::firstOrCreate(['name' => 'usuario']);
        Role::firstOrCreate(['name' => 'instructor']);

        // Asignar rol a un usuario específico (por ejemplo id=1)
        $user = User::find(1);
        if ($user) {
            $user->assignRole('admin');  // usando Spatie
        }
    }
}
