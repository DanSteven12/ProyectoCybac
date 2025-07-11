<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\MembershipService; // ✅ Importación correcta


class CheckMembershipExpirations extends Command
{
    protected $signature = 'check:memberships';
    protected $description = 'Verifica membresías vencidas y próximas a vencer, actualiza estados y envía notificaciones.';

    public function handle()
    {
        app(MembershipService::class)->verificarVencimientos($this);
        $this->info('✅ Verificación de membresías completada.');
    }
}
