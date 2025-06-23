    <!DOCTYPE html>
    <html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Reporte de Pagos - {{ ucfirst($estado) }}</title>
        <style>
            body { font-family: Arial, sans-serif; }
            .header { text-align: center; margin-bottom: 20px; }
            .title { font-size: 18px; font-weight: bold; }
            .subtitle { font-size: 14px; margin-bottom: 10px; }
            .date { font-size: 12px; color: #555; }
            .table { width: 100%; border-collapse: collapse; margin-top: 15px; }
            .table th, .table td { border: 1px solid #ddd; padding: 8px; }
            .table th { background-color: #1A365D; color: white; text-align: left; }
            .table tr:nth-child(even) { background-color: #f2f2f2; }
            .total { margin-top: 15px; font-weight: bold; text-align: right; }
            .footer { margin-top: 30px; font-size: 10px; text-align: center; color: #777; }
        </style>
    </head>
    <body>
        <div class="header">
            <div class="title">Reporte de Pagos - {{ ucfirst($estado) }}</div>
            <div class="subtitle">Gimnasio PowerFit</div>
            <div class="date">{{ $meses[$mes] }} de {{ $anio }}</div>
        </div>
        
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Usuario</th>
                    <th>Membresía</th>
                    <th>Monto</th>
                    <th>Fecha</th>
                    @if($estado == 'rechazado')
                    <th>Motivo</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach($payments as $index => $payment)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $payment->user->names }} {{ $payment->user->last_name }}</td>
                    <td>{{ $payment->membership->name }} ({{ $payment->membership->duration }} días)</td>
                    <td>${{ number_format($payment->price, 2) }}</td>
                    <td>{{ \Carbon\Carbon::parse($payment->date)->format('d/m/Y') }}</td>
                    @if($estado == 'rechazado')
                    <td>{{ $payment->comment ?? 'Sin comentario' }}</td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
        
        @if($estado == 'aprobado' && $total)
        <div class="total">
            Total de ventas: ${{ number_format($total, 2) }} | 
            Total de membresías: {{ $payments->count() }}
        </div>
        @endif
        
        <div class="footer">
            Generado el {{ now()->format('d/m/Y H:i') }} | PowerFit System v1.0
        </div>

    </body>
    </html>

