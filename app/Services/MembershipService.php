<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\Payment;
use App\Models\Status;
use Illuminate\Support\Facades\Log;
use App\Notifications\MembershipToExpireNotification;
use App\Notifications\MembershipExpiredNotification;

class MembershipService
{
    public function verificarVencimientos($command = null)
    {
        $hoy = Carbon::today();

        // Obtener IDs de estado
        $statusApprovedId = Status::where('name', 'Aprobado')->where('type', 2)->value('id');  // pagos
        $statusDuePaymentId = Status::where('name', 'Vencido')->where('type', 2)->value('id'); // pagos
        $activeStatusId = Status::where('name', 'Activo')->where('type', 1)->value('id');       // usuarios
        $inactiveStatusId = Status::where('name', 'Inactivo')->where('type', 1)->value('id');   // usuarios

        // ✅ Reactivar usuarios con pagos válidos
        $usersWithValidPayments = Payment::with(['membership', 'user'])
            ->where('status_id', $statusApprovedId)
            ->whereHas('membership', fn($q) => $q->where('status_id', $activeStatusId))
            ->get()
            ->groupBy('user_id');

        foreach ($usersWithValidPayments as $userPayments) {
            $user = $userPayments->first()->user;

            $hasValid = $userPayments->contains(function ($p) {
                return now()->lessThan(
                    Carbon::parse($p->date)->addDays($p->membership->duration ?? 0)->startOfDay()
                );
            });

            if ($hasValid && $user->status_id !== $activeStatusId) {
                $user->update(['status_id' => $activeStatusId]);
                $command?->info("🟢 Usuario {$user->email} reactivado automáticamente.");
            }
        }

        // Verificar pagos
        $payments = Payment::with(['membership', 'user'])
            ->where('status_id', $statusApprovedId)
            ->whereHas('membership', fn($q) => $q->where('status_id', $activeStatusId))
            ->get();

        foreach ($payments as $payment) {
            $membership = $payment->membership;
            $user = $payment->user;

            if (!$membership || !$user) {
                $command?->warn("❌ Pago sin membresía o usuario (ID: {$payment->id})");
                continue;
            }

            $expirationDate = Carbon::parse($payment->date)
                ->addDays($membership->duration)
                ->startOfDay();

            if (now()->greaterThanOrEqualTo($expirationDate)) {
                if ($payment->status_id !== $statusDuePaymentId) {
                    $payment->update(['status_id' => $statusDuePaymentId]);
                    $user->notify(new MembershipExpiredNotification());
                    $command?->info("⚠️ Notificación de vencimiento enviada a {$user->email}");
                }

                $otherValid = Payment::where('user_id', $user->id)
                    ->where('status_id', $statusApprovedId)
                    ->where('id', '!=', $payment->id)
                    ->get()
                    ->filter(function ($p) {
                        return now()->lessThan(
                            Carbon::parse($p->date)->addDays($p->membership->duration ?? 0)->startOfDay()
                        );
                    });

                if ($otherValid->isEmpty() && $user->status_id !== $inactiveStatusId) {
                    $user->update(['status_id' => $inactiveStatusId]);
                    $command?->info("🔴 Usuario {$user->email} desactivado automáticamente.");
                }

                continue;
            }

            // Notificación por vencer
            $remainingDays = $hoy->diffInDays($expirationDate, false);

            if (in_array($remainingDays, [5, 4, 3, 2, 1])) {
                $user->notify(new MembershipToExpireNotification($remainingDays));
                $command?->info("📩 Notificación enviada a {$user->email} (faltan {$remainingDays} días)");
            }
        }
    }
}
