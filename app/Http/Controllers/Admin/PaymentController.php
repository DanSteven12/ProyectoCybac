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

        // Auto-update expired payments
        foreach ($payments as $payment) {
            $paymentDate = Carbon::parse($payment->date); // assuming 'date' is the payment date
            $durationDays = $payment->membership->duration; // duration in days
            $expirationDate = $paymentDate->copy()->addDays($durationDays);

            if (Carbon::now()->greaterThan($expirationDate) && $payment->status_id != 7) {
                $payment->update([
                    'status_id' => 7,
                    'admin_comment' => 'Payment automatically marked as expired.',
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
            'status_id' => 'required|in:4,5,6',
            'comment' => 'nullable|string|max:1000',
        ]);

        $statusId = $request->status_id;
        $comment = $request->comment;

        if ($statusId == 6 && empty($comment)) {
            return back()->withErrors(['comment' => 'Debes proporcionar un motivo para rechazar el pago.']);
        }

        $payment->update([
            'status_id' => $statusId,
            'comment' => $statusId == 6 
                ? $comment 
                : ($statusId == 5 
                    ? 'Pago aprobado por el administrador.' 
                    : 'Pago en revisión.')
        ]);

        return back()->with('status', 'Pago actualizado correctamente.');
    }
}
