<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Payment;
use App\Models\CenterInformation;
use App\Models\ServicesHome;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Relation::morphMap([
        'status' => \App\Models\Status::class, // Usa el nombre singular
    ]);

    // Pasar servicios y la información del centro a todas las vistas
    view()->composer('*', function ($view) {
        $view->with('services', ServicesHome::take(12)->get());
    });

    // CMS: Información del Centro disponible en todas las vistas
    View::composer('*', function ($view) {
        $centerInfo = CenterInformation::first();
        $view->with('centerInfo', $centerInfo);
    });

        Relation::morphMap([
        'users' => \App\Models\User::class,
    ]);
    
    View::composer('*', function ($view) {
    if (Auth::check()) {
        // Obtener pagos aprobados del usuario
        $payments = Payment::where('user_id', Auth::id())
            ->whereHas('status', fn($q) => $q->where('name', 'Aprobado'))
            ->get();

        // Filtrar pagos que estén vigentes sumando duración a la fecha
        $hasApprovedMembership = $payments->contains(function ($payment) {
            $paymentDate = Carbon::parse($payment->date);
            $durationDays = $payment->membership->duration ?? 30;
            $expirationDate = $paymentDate->copy()->addDays($durationDays);

            return $expirationDate->isFuture();
        });

        $view->with('hasApprovedMembership', $hasApprovedMembership);
    } else {
        $view->with('hasApprovedMembership', false);
    }
});

    }
}