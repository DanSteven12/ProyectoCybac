<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;

class PaymentHistoryController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $paymentsPending = Payment::with(['membership', 'status'])
            ->where('user_id', $userId)
            ->whereHas('status', fn($q) => $q->where('name', 'Pendiente de revisión'))
            ->latest()
            ->get();

        $paymentsApproved = Payment::with(['membership', 'status'])
            ->where('user_id', $userId)
            ->whereHas('status', fn($q) => $q->where('name', 'Aprobado'))
            ->latest()
            ->get();

        $paymentsRejected = Payment::with(['membership', 'status'])
            ->where('user_id', $userId)
            ->whereHas('status', fn($q) => $q->where('name', 'Rechazado'))
            ->latest()
            ->get();

        $paymentsExpired = Payment::with(['membership', 'status'])
            ->where('user_id', $userId)
            ->whereHas('status', fn($q) => $q->where('name', 'Vencido'))
            ->latest()
            ->get();

        return view('user.payments.index', compact(
            'paymentsPending',
            'paymentsApproved',
            'paymentsRejected',
            'paymentsExpired'
        ));
    }
}
