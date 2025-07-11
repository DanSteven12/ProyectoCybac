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

        // ✅ Activar usuarios inactivos que ahora tienen pagos vigentes
        $usersWithValidPayments = Payment::with(['membership', 'user'])
            ->where('status_id', $statusApprovedId)
            ->whereHas('membership', function ($q) use ($activeStatusId) {
                $q->where('status_id', $activeStatusId);
            })
            ->get()
            ->groupBy('user_id');

        foreach ($usersWithValidPayments as $userPayments) {
            $user = $userPayments->first()->user;

            $hasAtLeastOneValid = $userPayments->contains(function ($p) {
                $expirationDate = Carbon::parse($p->date)
                    ->addDays($p->membership->duration ?? 0)
                    ->startOfDay();

                return Carbon::now()->lessThan($expirationDate);
            });

            if ($hasAtLeastOneValid && $user->status_id !== $activeStatusId) {
                $user->update(['status_id' => $activeStatusId]);
                $this->info("🟢 Usuario {$user->email} reactivado automáticamente.");
            }
        }

        // Verificar pagos con membresías activas
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
                ->startOfDay(); // ✅ vencimiento desde inicio del día

            if (Carbon::now()->greaterThanOrEqualTo($expirationDate)) {
                if ($payment->status_id !== $statusDuePaymentId) {
                    $payment->update(['status_id' => $statusDuePaymentId]);

                    $user->notify(new MembershipExpiredNotification());
                    $this->info("⚠️ Notificación de vencimiento enviada a {$user->email}");
                }

                // Evaluar si debe desactivarse el usuario
                $otherValidPayments = Payment::where('user_id', $user->id)
                    ->where('status_id', $statusApprovedId)
                    ->where('id', '!=', $payment->id)
                    ->get()
                    ->filter(function ($p) {
                        $expirationDate = Carbon::parse($p->date)
                            ->addDays($p->membership->duration ?? 0)
                            ->startOfDay();

                        return Carbon::now()->lessThan($expirationDate);
                    });

                if ($otherValidPayments->isEmpty() && $user->status_id !== $inactiveStatusId) {
                    $user->update(['status_id' => $inactiveStatusId]);
                    $this->info("🔴 Usuario {$user->email} desactivado automáticamente.");
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
