<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusesSeeder extends Seeder
{
    public function run(): void
    {
        $statuses = [
            ['name' => 'Activo', 'type' => 1],
            ['name' => 'Inactivo', 'type' => 1],
            ['name' => 'Pendiente', 'type' => 1],

             // Estados para pagos o membresías
            ['name' => 'Pendiente de revisión', 'type' => 2],
            ['name' => 'Aprobado', 'type' => 2],
            ['name' => 'Rechazado', 'type' => 2],
        ];

        foreach ($statuses as $status) {
            DB::table('statuses')->updateOrInsert(
                ['name' => $status['name']],
                array_merge($status, [
                    'created_at' => now(),
                    'updated_at' => now(),
                ])
            );
        }
    }
}
