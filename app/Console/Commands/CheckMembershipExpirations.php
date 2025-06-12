<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\Membership;
use App\Models\Status;
use App\Notifications\MembresiaPorVencerNotification;
use App\Notifications\MembresiaVencidaNotification;

class CheckMembershipExpirations extends Command
{
    protected $signature = 'check:memberships';
    protected $description = 'Envía notificaciones para membresías próximas a vencer.';

    public function handle()
    {
        $now = Carbon::now();

        $activeStatusId = Status::where('name', 'Activo')->where('type', 1)->value('id');
        $expiredStatusId = Status::where('name', 'Vencida')->where('type', 1)->value('id');
        $paymentApprovedStatusId = Status::where('name', 'Aprobado')->where('type', 2)->value('id');

        $memberships = Membership::with(['latestPayment.status'])
            ->where('status_id', $activeStatusId)
            ->get();

        foreach ($memberships as $membership) {
            $payment = $membership->latestPayment;

            if (!$payment || $payment->status_id !== $paymentApprovedStatusId) {
                continue;
            }

            $expirationDate = Carbon::parse($payment->date)
                ->addDays($membership->duration ?? 30)
                ->endOfDay();

            // Cambia el estado si ya expiró
            if ($now->greaterThan($expirationDate)) {
                $membership->update(['status_id' => $expiredStatusId]);
                $payment->user->notify(new MembresiaVencidaNotification());
                continue;
            }

            $daysRemaining = $now->diffInDays($expirationDate, false);

            if (in_array($daysRemaining, [5, 4, 3, 2, 1])) {
                $payment->user->notify(new MembresiaPorVencerNotification($daysRemaining));
            }
        }

        $this->info('Notificaciones de vencimiento enviadas correctamente.');
    }
}


// namespace App\Console\Commands;

// use Illuminate\Console\Command;
// use Carbon\Carbon;
// use App\Models\Membership;
// use App\Models\Status;
// use App\Notifications\MembresiaPorVencerNotification;
// use App\Notifications\MembresiaVencidaNotification;

// class CheckMembershipExpirations extends Command
// {
//     protected $signature = 'check:memberships';
//     protected $description = 'Envía notificaciones para membresías próximas a vencer.';

//     public function handle()
//     {
//         $now = Carbon::now();

//         // Estado activo de la membresía (type = 1)
//         $activeStatusId = Status::where('name', 'Activo')->where('type', 1)->value('id');

//         // Estado vencido de la membresía (type = 1)
//         $expiredStatusId = Status::where('name', 'Vencida')->where('type', 1)->value('id');

//         // Estado aprobado del pago (type = 2)
//         $paymentApprovedStatusId = Status::where('name', 'Aprobado')->where('type', 2)->value('id');

//         // Obtener membresías activas con el último pago
//         $memberships = Membership::with(['latestPayment.status'])
//             ->where('status_id', $activeStatusId)
//             ->get();

//         foreach ($memberships as $membership) {
//             $payment = $membership->latestPayment;

//             // Verificar si hay pago aprobado
//             if (!$payment || $payment->status_id !== $paymentApprovedStatusId) {
//                 continue;
//             }

//             // Calcular la fecha de expiración desde la fecha del pago
//             $expirationDate = Carbon::parse($payment->date)
//                 ->addDays($membership->duration ?? 30)
//                 ->endOfDay();

//             // Si ya expiró, actualizar el status y notificar
//             if ($now->greaterThan($expirationDate)) {
//                 $membership->update(['status_id' => $expiredStatusId]);
//                 $payment->user->notify(new MembresiaVencidaNotification());
//                 continue;
//             }

//             $daysRemaining = $now->diffInDays($expirationDate, false);
//             $hoursRemaining = $now->diffInHours($expirationDate, false);

//             // Enviar notificaciones previas al vencimiento
//             if (in_array($daysRemaining, [5, 4, 3, 2, 1])) {
//                 $payment->user->notify(new MembresiaPorVencerNotification($daysRemaining));
//             }

//             if ($daysRemaining === 0 && $hoursRemaining === 14) {
//                 $payment->user->notify(new MembresiaPorVencerNotification('menos de 14 horas'));
//             }
//         }

//         $this->info('Notificaciones de vencimiento enviadas correctamente.');
//     }
// }
