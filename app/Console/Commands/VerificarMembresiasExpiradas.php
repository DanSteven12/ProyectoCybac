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
        $pagosActivos = Payment::where('status_id', 1)->get();

        foreach ($pagosActivos as $pago) {
            $endDate = match ($pago->membership_id) {
                1 => Carbon::parse($pago->date)->addDays(30),
                2 => Carbon::parse($pago->date)->addDays(180),
                3 => Carbon::parse($pago->date)->addDays(365),
                default => Carbon::parse($pago->date)->addDays(30),
            };

            if (Carbon::now()->gt($endDate)) {
                $pago->update(['status_id' => 2]); // 2 = inactiva o vencida
            }
        }

        $this->info('Membresías vencidas actualizadas correctamente.');
    }
}