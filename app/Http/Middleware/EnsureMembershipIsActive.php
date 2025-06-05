<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Status;
use Carbon\Carbon;

class CheckActiveMembership
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        $approvedStatusId = Status::where('name', 'Aprobado')
            ->where('type', 2) // Tipo 2: estados de pago/membresía
            ->value('id');

        // Obtenemos el pago aprobado más reciente
        $activePayment = $user->payments()
            ->where('status_id', $approvedStatusId)
            ->latest()
            ->first();

        if (!$activePayment) {
            return redirect()->route('memberships.index')
                ->with('warning', 'Necesitas una membresía aprobada y vigente para acceder.');
        }

        // Calculamos la fecha de expiración sumando duración a la fecha de pago
        $paymentDate = Carbon::parse($activePayment->date);
        $durationDays = $activePayment->membership->duration ?? 30;
        $expirationDate = $paymentDate->copy()->addDays($durationDays);

        // Verificamos si la membresía ya expiró
        if ($expirationDate->isPast()) {
            return redirect()->route('memberships.index')
                ->with('warning', 'Tu membresía ha vencido. Necesitas renovarla.');
        }

        return $next($request);
    }
}
