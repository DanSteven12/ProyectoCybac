@extends('layouts.instructor-app-master')
@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

<style>
.class-records {
    --cr-ink: #25223b;
    --cr-muted: #716d85;
    --cr-purple: #6554c0;
    --cr-border: #eae7f2;
    font-family: 'Segoe UI', sans-serif;
    color: var(--cr-ink);
    background: #f7f6fb;
    border-radius: 24px;
    padding: clamp(20px, 4vw, 48px);
    margin: 24px auto;
    max-width: 1400px;
    width: calc(100% - 32px);
    line-height: 1.5;
}
.class-records, .class-records * { box-sizing: border-box; }
.class-records .cr-header { display: flex; align-items: center; justify-content: space-between; gap: 24px; margin-bottom: 32px; }
.class-records .cr-eyebrow { display: flex; align-items: center; gap: 8px; color: var(--cr-purple); font-size: 11px; font-weight: 700; letter-spacing: 2px; text-transform: uppercase; margin: 0 0 12px; }
.class-records .cr-eyebrow::before { content: ''; width: 20px; height: 2px; background: currentColor; }
.class-records h1 { font-size: clamp(26px, 4vw, 38px); letter-spacing: -1.3px; line-height: 1.15; font-weight: 750; margin: 0 0 12px; color: var(--cr-ink); }
.class-records .cr-subtitle { color: var(--cr-muted); font-size: 14px; margin: 0; max-width: 520px; }
.class-records .cr-header-icon { display: grid; place-items: center; width: 76px; height: 76px; flex-shrink: 0; color: var(--cr-purple); background: #eeebfa; border: 1px solid #e2dcf7; border-radius: 24px; font-size: 28px; }
.class-records .cr-panel { background: #fff; border: 1px solid var(--cr-border); border-radius: 18px; overflow: hidden; box-shadow: 0 8px 32px #30264e06; }
.class-records .cr-panel-header { padding: 24px 28px; display: flex; align-items: center; justify-content: space-between; gap: 16px; }
.class-records .cr-panel-title { display: flex; align-items: center; gap: 10px; flex-wrap: wrap; }
.class-records h2 { font-size: 17px; font-weight: 650; margin: 0; color: var(--cr-ink); }
.class-records .cr-count { color: var(--cr-purple); background: #f0edfb; padding: 3px 10px; border-radius: 8px; font-size: 12px; font-weight: 700; }
.class-records .cr-panel-note { font-size: 12px; color: var(--cr-muted); margin: 0; }
.class-records .cr-table-wrap { overflow-x: auto; }
.class-records .cr-table { border-collapse: collapse; width: 100%; text-align: left; margin: 0; }
.class-records .cr-table th { padding: 14px 20px; background: #faf9fd; border-block: 1px solid var(--cr-border); font-size: 10px; text-transform: uppercase; letter-spacing: 1.2px; color: var(--cr-muted); font-weight: 700; white-space: nowrap; }
.class-records .cr-table td { padding: 22px 20px; border-bottom: 1px solid #f0edf5; font-size: 13px; vertical-align: middle; }
.class-records .cr-table th:first-child, .class-records .cr-table td:first-child { padding-left: 28px; }
.class-records .cr-table tbody tr:last-child td { border-bottom: none; }
.class-records .cr-table tbody tr:hover { background: #fcfbff; }
.class-records .cr-person { display: flex; align-items: center; gap: 12px; min-width: 170px; }
.class-records .cr-avatar { display: grid; place-items: center; height: 40px; width: 40px; flex-shrink: 0; background: #eeeafa; color: #6957ae; border-radius: 13px; font-size: 13px; font-weight: 700; }
.class-records tr:nth-child(3n+2) .cr-avatar { background: #e7f3ef; color: #367763; }
.class-records tr:nth-child(3n+3) .cr-avatar { background: #fdf0e4; color: #986339; }
.class-records .cr-name { font-weight: 650; overflow-wrap: anywhere; }
.class-records .cr-service { display: inline-block; padding: 5px 10px; background: #f5f4f8; border: 1px solid #eeecf3; border-radius: 7px; font-size: 12px; }
.class-records .cr-date { white-space: nowrap; }
.class-records .cr-time { white-space: nowrap; font-variant-numeric: tabular-nums; color: var(--cr-muted); }
.class-records .cr-time i { margin-right: 5px; font-size: 11px; }
.class-records .cr-description { color: var(--cr-muted); min-width: 140px; max-width: 260px; overflow-wrap: anywhere; }
.class-records .cr-status { display: inline-flex; align-items: center; gap: 6px; padding: 5px 10px; border-radius: 30px; font-size: 11px; font-weight: 650; white-space: nowrap; }
.class-records .cr-status::before { content: ''; height: 5px; width: 5px; border-radius: 50%; background: currentColor; }
.class-records .cr-completed { background: #eaf5ef; color: #28714f; }
.class-records .cr-upcoming { background: #f0edfc; color: #6650b4; }
.class-records .cr-footer { display: flex; align-items: center; gap: 8px; padding: 18px 28px; border-top: 1px solid var(--cr-border); font-size: 12px; color: var(--cr-muted); background: #fdfcfe; }
.class-records .cr-footer i { color: #9991b3; }
.class-records .cr-alert { display: flex; align-items: center; gap: 12px; padding: 15px 18px; margin-bottom: 20px; border-radius: 12px; font-size: 14px; overflow-wrap: anywhere; }
.class-records .cr-success { color: #286447; background: #e9f5ee; border: 1px solid #cde8d8; }
.class-records .cr-error { color: #a33d43; background: #fff0f0; border: 1px solid #f4d2d4; }
.class-records .cr-empty { padding: 64px 24px; text-align: center; border-top: 1px solid var(--cr-border); }
.class-records .cr-empty-icon { display: grid; place-items: center; margin: 0 auto 20px; width: 72px; height: 72px; border-radius: 24px; background: #f1eefb; color: var(--cr-purple); font-size: 26px; }
.class-records .cr-empty h3 { margin: 0 0 10px; font-size: 20px; color: var(--cr-ink); }
.class-records .cr-empty p { margin: 0 auto; max-width: 380px; font-size: 14px; color: var(--cr-muted); }
.class-records .cr-sr-only { position: absolute; width: 1px; height: 1px; padding: 0; margin: -1px; overflow: hidden; clip: rect(0,0,0,0); white-space: nowrap; border: 0; }
@media (max-width: 768px) {
    .class-records { width: calc(100% - 16px); padding: 24px 14px; margin: 12px auto; border-radius: 18px; }
    .class-records .cr-header { gap: 12px; margin-bottom: 24px; }
    .class-records .cr-header-icon { width: 48px; height: 48px; border-radius: 15px; font-size: 20px; }
    .class-records .cr-panel-header { padding: 20px; flex-wrap: wrap; gap: 6px; }
    .class-records .cr-panel-note { width: 100%; }
    .class-records .cr-table-wrap { overflow: visible; padding: 0 12px 12px; }
    .class-records .cr-table, .class-records .cr-table tbody { display: block; }
    .class-records .cr-table thead { position: absolute; width: 1px; height: 1px; overflow: hidden; clip: rect(0,0,0,0); }
    .class-records .cr-table tbody tr { display: block; border: 1px solid var(--cr-border); border-radius: 12px; margin-bottom: 12px; padding: 4px 16px 12px; }
    .class-records .cr-table tbody tr:last-child { margin-bottom: 0; }
    .class-records .cr-table td { display: grid; grid-template-columns: 90px minmax(0, 1fr); align-items: start; gap: 10px; padding: 8px 0; border: none; min-width: 0; max-width: none; }
    .class-records .cr-table td::before { content: attr(data-label); color: var(--cr-muted); font-size: 12px; font-weight: 500; }
    .class-records .cr-table td:first-child { display: block; padding: 14px 0; margin-bottom: 8px; border-bottom: 1px solid var(--cr-border); }
    .class-records .cr-table td:first-child::before { display: none; }
    .class-records .cr-service, .class-records .cr-status { justify-self: start; }
    .class-records .cr-date { white-space: normal; }
    .class-records .cr-footer { padding: 16px 20px; }
}
</style>

<div class="class-records">
    <header class="cr-header">
        <div>
            <p class="cr-eyebrow">Panel de instructor</p>
            <h1>Registros de clases</h1>
            <p class="cr-subtitle">Tus clases, tu comunidad. Consulta los alumnos inscritos y los detalles de cada sesión.</p>
        </div>
        <div class="cr-header-icon" aria-hidden="true"><i class="fas fa-chalkboard-teacher"></i></div>
    </header>

    @if(session('success'))
        <div class="cr-alert cr-success" role="status">
            <i class="fas fa-circle-check" aria-hidden="true"></i>
            <span>{{ session('success') }}</span>
        </div>
    @elseif(session('error'))
        <div class="cr-alert cr-error" role="alert">
            <i class="fas fa-circle-exclamation" aria-hidden="true"></i>
            <span>{{ session('error') }}</span>
        </div>
    @endif

    <section class="cr-panel" aria-labelledby="cr-list-title">
        <div class="cr-panel-header">
            <div class="cr-panel-title">
                <h2 id="cr-list-title">Alumnos inscritos</h2>
                <span class="cr-count">{{ $registrations->count() }} registros</span>
            </div>
            <p class="cr-panel-note">Detalle de inscripciones</p>
        </div>

        @if($registrations->isEmpty())
            <div class="cr-empty">
                <div class="cr-empty-icon" aria-hidden="true"><i class="fas fa-user-group"></i></div>
                <h3>Tu próxima clase empieza aquí</h3>
                <p>Aún no tienes alumnos registrados. Cuando se inscriban en tus clases, podrás ver sus datos en este espacio.</p>
            </div>
        @else
            <div class="cr-table-wrap">
                <table class="cr-table" role="table">
                    <caption class="cr-sr-only">Alumnos registrados en tus clases programadas</caption>
                    <thead role="rowgroup">
                        <tr role="row">
                            <th scope="col" role="columnheader">Alumno</th>
                            <th scope="col" role="columnheader">Servicio</th>
                            <th scope="col" role="columnheader">Fecha</th>
                            <th scope="col" role="columnheader">Hora</th>
                            <th scope="col" role="columnheader">Descripción</th>
                            <th scope="col" role="columnheader">Estado</th>
                        </tr>
                    </thead>
                    <tbody role="rowgroup">
                        @foreach($registrations as $registration)
                            @php
                                $classDate = \Carbon\Carbon::parse($registration->class->date);
                                $isPast = $classDate->isPast();
                                $statusClass = $isPast ? 'cr-completed' : 'cr-upcoming';
                                $statusText = $isPast ? 'Completada' : 'Próxima';
                                $initials = \Illuminate\Support\Str::upper(
                                    \Illuminate\Support\Str::substr($registration->user->names, 0, 1) .
                                    \Illuminate\Support\Str::substr($registration->user->last_name, 0, 1)
                                );
                            @endphp
                            <tr role="row">
                                <td data-label="Alumno" role="cell">
                                    <div class="cr-person">
                                        <span class="cr-avatar" aria-hidden="true">{{ $initials }}</span>
                                        <span class="cr-name">{{ $registration->user->names }} {{ $registration->user->last_name }}</span>
                                    </div>
                                </td>
                                <td data-label="Servicio" role="cell"><span class="cr-service">{{ $registration->class->service->name }}</span></td>
                                <td data-label="Fecha" class="cr-date" role="cell">{{ $classDate->translatedFormat('d \d\e M, Y') }}</td>
                                <td data-label="Hora" class="cr-time" role="cell"><span><i class="far fa-clock" aria-hidden="true"></i>{{ \Carbon\Carbon::parse($registration->class->time)->format('h:i A') }}</span></td>
                                <td data-label="Descripción" class="cr-description" role="cell">{{ \Illuminate\Support\Str::limit($registration->class->description, 50, '...') }}</td>
                                <td data-label="Estado" role="cell"><span class="cr-status {{ $statusClass }}">{{ $statusText }}</span></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <footer class="cr-footer">
                <i class="fas fa-list-check" aria-hidden="true"></i>
                <span>Mostrando {{ $registrations->count() }} registros</span>
            </footer>
        @endif
    </section>
</div>
@endsection
