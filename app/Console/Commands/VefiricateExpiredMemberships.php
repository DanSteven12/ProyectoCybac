<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Payment;
use App\Models\Status;
use Carbon\Carbon;

class VefiricateExpiredMemberships extends Command
{
    protected $signature = 'verificar:membresias';
    protected $description = 'Marca los pagos aprobados como vencidos si han expirado.';

    public function handle()
    {
        $now = Carbon::now();

        $statusApprovedId = Status::where('name', 'Aprobado')->where('type', 2)->value('id');
        $statusDuePaymentId = Status::where('name', 'Vencida')->where('type', 2)->value('id');

        $payments = Payment::with('membership')
            ->where('status_id', $statusApprovedId)
            ->get();

        foreach ($payments as $payment) {
            if (!$payment->membership) {
                continue;
            }

            $expirationDate = Carbon::parse($payment->date)
                ->addDays($payment->membership->duration)
                ->endOfDay();

            if ($now->greaterThan($expirationDate)) {
                $payment->update(['status_id' => $statusDuePaymentId]);
            }
        }

        $this->info('Pagos vencidos actualizados correctamente.');
    }
}
