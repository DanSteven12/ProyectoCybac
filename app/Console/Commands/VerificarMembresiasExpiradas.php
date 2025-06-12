<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Payment;
use App\Models\Status;
use Carbon\Carbon;

class VerificarMembresiasExpiradas extends Command
{
    protected $signature = 'verificar:membresias';
    protected $description = 'Marca los pagos aprobados como vencidos si han expirado.';

    public function handle()
    {
        $now = Carbon::now();

        $statusAprobadoId = Status::where('name', 'Aprobado')->where('type', 2)->value('id');
        $statusPagoVencidoId = Status::where('name', 'Vencida')->where('type', 2)->value('id');

        $pagos = Payment::with('membership')
            ->where('status_id', $statusAprobadoId)
            ->get();

        foreach ($pagos as $pago) {
            if (!$pago->membership) {
                continue;
            }

            $fechaExpiracion = Carbon::parse($pago->date)
                ->addDays($pago->membership->duration)
                ->endOfDay();

            if ($now->greaterThan($fechaExpiracion)) {
                $pago->update(['status_id' => $statusPagoVencidoId]);
            }
        }

        $this->info('Pagos vencidos actualizados correctamente.');
    }
}

// namespace App\Console\Commands;

// use Illuminate\Console\Command;
// use App\Models\Payment;
// use App\Models\Status;
// use Carbon\Carbon;

// class VerificarMembresiasExpiradas extends Command
// {
//     protected $signature = 'verificar:membresias';
//     protected $description = 'Marca los pagos aprobados como vencidos si han expirado.';

//     public function handle()
//     {
//         $now = Carbon::now();

//         // IDs de estados
//         $statusAprobadoId = Status::where('name', 'Aprobado')->where('type', 2)->value('id'); // estado de pago activo
//         $statusPagoVencidoId = Status::where('name', 'Vencida')->where('type', 2)->value('id'); // estado de pago vencido

//         // Obtener todos los pagos aprobados con su membresía
//         $pagos = Payment::with('membership')
//             ->where('status_id', $statusAprobadoId)
//             ->get();

//         foreach ($pagos as $pago) {
//             if (!$pago->membership) {
//                 continue;
//             }

//             $fechaExpiracion = Carbon::parse($pago->date)
//                 ->addDays($pago->membership->duration)
//                 ->endOfDay();

//             if ($now->greaterThan($fechaExpiracion)) {
//                 $pago->update(['status_id' => $statusPagoVencidoId]);
//             }
//         }

//         $this->info('Pagos vencidos actualizados correctamente.');
//     }
// }
