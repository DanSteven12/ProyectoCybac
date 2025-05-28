<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class EnsureMembershipIsActive
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        $activePayment = $user->payments()
            ->where('status_id', 1) // Asumiendo 1 = "activo"
            ->latest()
            ->first();

        if (!$activePayment) {
            return redirect()->route('memberships.index')
                ->with('warning', 'Necesitas pagar una membresía activa para acceder.');
        }

        return $next($request);
    }
}
