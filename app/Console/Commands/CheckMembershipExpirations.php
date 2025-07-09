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
    protected $description = 'Verifica membresías vencidas y próximas a vencer, actualiza estados y envía notificaciones.';

    public function handle()
    {
        $hoy = Carbon::today();

        // Obtener IDs de estado
        $statusApprovedId = Status::where('name', 'Aprobado')->where('type', 2)->value('id');  // pagos
        $statusDuePaymentId = Status::where('name', 'Vencido')->where('type', 2)->value('id'); // pagos
        $activeStatusId = Status::where('name', 'Activo')->where('type', 1)->value('id');       // usuarios
        $inactiveStatusId = Status::where('name', 'Inactivo')->where('type', 1)->value('id');   // usuarios

        // Obtener pagos aprobados con membresías activas
        $payments = Payment::with(['membership', 'user'])
            ->where('status_id', $statusApprovedId)
            ->whereHas('membership', function ($q) use ($activeStatusId) {
                $q->where('status_id', $activeStatusId);
            })
            ->get();

        foreach ($payments as $payment) {
            $membership = $payment->membership;
            $user = $payment->user;

            if (!$membership || !$user) {
                $this->warn("❌ Error: Pago sin membresía o sin usuario (Pago ID: {$payment->id})");
                continue;
            }

            $expirationDate = Carbon::parse($payment->date)
                ->addDays($membership->duration)
                ->endOfDay();

            if (Carbon::now()->greaterThan($expirationDate)) {
                if ($payment->status_id !== $statusDuePaymentId) {
                    $payment->update(['status_id' => $statusDuePaymentId]);

                    $user->notify(new MembershipExpiredNotification());
                    $this->info("⚠️ Notificación de vencimiento enviada a {$user->email}");

                    // Verificar si el usuario tiene otros pagos aún vigentes
                    $otherValidPayments = Payment::where('user_id', $user->id)
                        ->where('status_id', $statusApprovedId)
                        ->where('id', '!=', $payment->id)
                        ->get()
                        ->filter(function ($p) {
                            $expirationDate = Carbon::parse($p->date)
                                ->addDays($p->membership->duration ?? 0)
                                ->endOfDay();

                            return Carbon::now()->lessThanOrEqualTo($expirationDate);
                        });

                    // Si no tiene otras membresías activas, inactivar usuario
                    if ($otherValidPayments->isEmpty() && $user->status_id !== $inactiveStatusId) {
                        $user->update(['status_id' => $inactiveStatusId]);
                        $this->info("🔴 Usuario {$user->email} desactivado automáticamente.");
                    }
                }
                continue;
            }

            // Notificar si está por vencer
            $remainingDays = $hoy->diffInDays($expirationDate->copy()->startOfDay(), false);

            if (in_array($remainingDays, [5, 4, 3, 2, 1])) {
                $user->notify(new MembershipToExpireNotification($remainingDays));
                $this->info("📩 Notificación de membresía por vencer enviada a {$user->email} (faltan {$remainingDays} días)");
            }
        }

        $this->info('✅ Verificación de membresías completada.');
    }
}
