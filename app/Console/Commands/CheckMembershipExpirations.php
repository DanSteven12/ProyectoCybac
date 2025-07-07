<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\Payment;
use App\Models\Status;
use App\Notifications\MembershipToExpireNotification;
use App\Notifications\MembershipExpiredNotification;

class CheckMembershipExpirations extends Command
{
    protected $signature = 'check:memberships';
    protected $description = 'Envía notificaciones para membresías próximas a vencer.';

    public function handle()
{
    $hoy = Carbon::today();

    // IDs de status necesarios
    $statusApprovedId = Status::where('name', 'Aprobado')->where('type', 2)->value('id');
    $statusDuePaymentId = Status::where('name', 'Vencida')->where('type', 2)->value('id');
    $activeStatusId = Status::where('name', 'Activo')->where('type', 1)->value('id');
    $inactiveStatusId = Status::where('name', 'Inactivo')->where('type', 1)->value('id'); // <-- Estado Inactivo para usuarios

    // Pagos aprobados, con membresía activa
    $payments = Payment::with(['membership', 'user'])
        ->where('status_id', $statusApprovedId)
        ->whereHas('membership', function ($q) use ($activeStatusId) {
            $q->where('status_id', $activeStatusId);
        })
        ->get();

    foreach ($payments as $payment) {
        $membership = $payment->membership;

        if (!$membership) {
            $this->warn("❌ Sin membresía: Pago ID {$payment->id}");
            continue;
        }

        // Fecha de expiración
        $expirationDate = Carbon::parse($payment->date)
            ->addDays($membership->duration)
            ->endOfDay();

        // Si ya venció
        if (Carbon::now()->greaterThan($expirationDate)) {
            if ($payment->status_id !== $statusDuePaymentId) {
                // Cambiar status del pago a Vencida
                $payment->update(['status_id' => $statusDuePaymentId]);

                // Notificar al usuario que su membresía venció
                $payment->user->notify(new MembershipExpiredNotification());

                // Cambiar status del usuario a Inactivo si no está ya inactivo
                if ($payment->user->status_id !== $inactiveStatusId) {
                    $payment->user->update(['status_id' => $inactiveStatusId]);
                    $this->info("Usuario {$payment->user->email} desactivado automáticamente.");
                }

                $this->info("⚠️ Notificación de vencida enviada a {$payment->user->email}");
            }
            continue;
        }

        // Días restantes para notificaciones anticipadas
        $remainingDays = $hoy->diffInDays($expirationDate->copy()->startOfDay(), false);

        if (in_array($remainingDays, [5, 4, 3, 2, 1])) {
            $payment->user->notify(new MembershipToExpireNotification($remainingDays));
            $this->info("📩 Notificación enviada a {$payment->user->email} ({$remainingDays} días restantes)");
        }
    }

    $this->info('✅ Verificación completada');
}

}

