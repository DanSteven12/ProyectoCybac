<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'names' => 'Administrador',
            'last_name' => 'Principal',
            'birth_date' => '1990-01-01',
            'gender' => 'Masculino',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'), // usa bcrypt seguro
            'status_id' => 1,
        ]);
    }
}
