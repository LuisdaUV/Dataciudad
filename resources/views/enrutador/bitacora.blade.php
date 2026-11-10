@extends('layouts.app')
@section('title', 'Bitácora diaria | DataCiudad')
@section('content')
<div class="card">
    <h1>Bitácora diaria de solicitudes</h1>
    <p class="muted">Solicitudes registradas el {{ now()->format('d/m/Y') }} en todos los puntos de atención.</p>
    <p><strong>Total del día:</strong> {{ $solicitudes->count() }}</p>
    <div style="overflow-x:auto">
    <table>
        <thead><tr><th>ID</th><th>Fecha y hora</th><th>Usuario</th><th>Celular</th><th>Comuna / Corregimiento</th><th>Barrio</th><th>Dirección</th><th>Punto de atención</th><th>Coordenadas</th><th>Registró</th></tr></thead>
        <tbody>
        @forelse($solicitudes as $solicitud)
            <tr>
                <td>{{ $solicitud->id }}</td>
                <td>{{ $solicitud->created_at?->format('H:i:s') }}</td>
                <td>{{ $solicitud->nombres }} {{ $solicitud->apellidos }}</td>
                <td>{{ $solicitud->celular }}</td>
                <td>{{ $solicitud->comuna_corregimiento }}</td>
                <td>{{ $solicitud->barrio }}</td>
                <td>{{ $solicitud->direccion }}</td>
                <td>{{ $solicitud->punto_atencion }}</td>
                <td>{{ $solicitud->latitud }}, {{ $solicitud->longitud }}</td>
                <td>{{ $solicitud->usuario?->name ?? 'Usuario no disponible' }}</td>
            </tr>
        @empty
            <tr><td colspan="10" style="text-align:center">No hay solicitudes registradas hoy.</td></tr>
        @endforelse
        </tbody>
    </table>
    </div>
</div>
@endsection
