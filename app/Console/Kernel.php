<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Los comandos Artisan personalizados.
     *
     * @var array
     */
    protected $commands = [
        \App\Console\Commands\NotifyCancelledClasses::class,
        \App\Console\Commands\CheckMembershipExpirations::class,
    ];

    /**
     * Define el horario de los comandos.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('verificar:membresias')->daily();
        $schedule->command('check:memberships')->hourly();
        // $schedule->command('check:memberships')->everyMinute(); // Notifica y actualiza
        // $schedule->command('verificar:membresias')->everyMinute(); // (opcional extra)


        $schedule->command('classes:notify-cancelled')->everyMinute();


    }

    /**
     * Registra los comandos para la aplicación.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
