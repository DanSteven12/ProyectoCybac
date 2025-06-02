<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Payment;
use Carbon\Carbon;

class VerificarMembresiasExpiradas extends Command
{
    protected $signature = 'verificar:membresias';
    protected $description = 'Verifica y cancela automáticamente las membresías expiradas';

    public function handle()
    {
        $pagosActivos = Payment::with('membership')->where('status_id', 1)->get();

        foreach ($pagosActivos as $pago) {
            // Asegura que exista la relación con la membresía
            if ($pago->membership) {
                $fechaExpiracion = Carbon::parse($pago->date)->addDays($pago->membership->duration);

                if (now()->greaterThan($fechaExpiracion)) {
                    $pago->update(['status_id' => 2]); // 2 = vencida
                }
            }
        }

        $this->info('Membresías vencidas actualizadas correctamente.');
    }
}
