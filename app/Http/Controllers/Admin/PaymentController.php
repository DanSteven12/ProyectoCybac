<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with(['user', 'membership', 'status'])->latest()->get();

        // Auto-update expired payments (estatus 'Vencido' = 7)
        foreach ($payments as $payment) {
            $paymentDate = Carbon::parse($payment->date);
            $durationDays = $payment->membership->duration ?? 30;
            $expirationDate = $paymentDate->copy()->addDays($durationDays);

            if (Carbon::now()->greaterThan($expirationDate) && $payment->status_id != 7) {
                $payment->update([
                    'status_id' => 7, // Vencido
                    'comment' => 'Pago marcado automáticamente como vencido.',
                ]);
            }
        }

        return view('admin.payments.index', compact('payments'));
    }

    public function show(Payment $payment)
    {
        return view('admin.payments.show', compact('payment'));
    }

    public function update(Request $request, Payment $payment)
    {
        $request->validate([
            'status_id' => 'required|in:4,5,6', // 4 = Pendiente, 5 = Aprobado, 6 = Rechazado
            'comment' => 'nullable|string|max:1000',
        ]);

        $statusId = $request->status_id;
        $comment = $request->comment;

        if ($statusId == 6 && empty($comment)) {
            return back()->withErrors(['comment' => 'Debes proporcionar un motivo para rechazar el pago.']);
        }

        $updateData = [
            'status_id' => $statusId,
            'comment' => $statusId == 6 
                ? $comment 
                : ($statusId == 5 
                    ? 'Pago aprobado por el administrador.' 
                    : 'Pago en revisión.')
        ];

        $payment->update($updateData);

        return back()->with('status', 'Pago actualizado correctamente.');
    }
}
