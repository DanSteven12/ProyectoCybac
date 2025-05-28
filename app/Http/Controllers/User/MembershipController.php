<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Membership;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class MembershipController extends Controller
{
    // Mostrar membresías activas para el usuario
    public function index()
    {
        $memberships = Membership::where('status_id', 1)->get(); // Solo activas
        return view('user.memberships.index', compact('memberships'));
    }

    // Mostrar detalle de membresía y opción de pago
    public function pay(Membership $membership)
    {
        return view('user.memberships.pay', compact('membership'));
    }

    // Mostrar formulario para subir comprobante
    public function uploadReceipt(Membership $membership)
    {
        return view('user.memberships.upload-receipt', compact('membership'));
    }

    // Procesar carga del comprobante
    public function storeReceipt(Request $request)
    {
        $request->validate([
            'membership_id' => 'required|exists:memberships,id',
            'date' => 'required|date',
            'price' => 'required|numeric',
            'receipt' => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
        ]);

        $user = Auth::user();

        $filePath = $request->file('receipt')->store('comprobantes', 'public');

        Payment::create([
            'user_id' => $user->id,
            'membership_id' => $request->membership_id,
            'status_id' => 2, // Pendiente de revisión
            'date' => $request->date,
            'price' => $request->price,
            'receipt_url' => $filePath,
            'comment' => null, // El admin agregará comentario si es rechazado
        ]);

        return redirect()->route('dashboard')->with('status', 'Comprobante enviado. Espera la validación del administrador.');
    }

    // Validar vigencia actual del usuario
    public function verificarVigencia()
    {
        $payment = Payment::where('user_id', Auth::id())->latest()->first();

        if (!$payment) {
            return redirect()->back()->withErrors('No has contratado una membresía activa.');
        }

        $endDate = Carbon::parse($payment->date)->addDays($payment->membership->duration ?? 30);
        $isExpired = Carbon::now()->gt($endDate);

        if ($isExpired) {
            return redirect()->back()->withErrors('Tu membresía ha vencido. No puedes agendar clases.');
        }

        return true;
    }
}
