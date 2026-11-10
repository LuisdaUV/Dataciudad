@extends('layouts.app')
@section('title', 'Panel principal | DataCiudad')
@section('content')
<div class="card">
    <h1>Bienvenido, {{ auth()->user()->name }}</h1>
    <p>Has iniciado sesión correctamente en DataCiudad.</p>
    <p>Perfil: <strong>{{ ucfirst(auth()->user()->role) }}</strong></p>
    @if(auth()->user()->role === 'ventanilla')
        <p>Desde este perfil puedes registrar solicitudes y marcar su ubicación en el mapa.</p>
        <a class="btn" href="{{ route('ventanilla.solicitudes.create') }}">Registrar solicitud</a>
    @elseif(auth()->user()->role === 'enrutador')
        <p>Desde este perfil puedes consultar la bitácora diaria consolidada de solicitudes.</p>
        <a class="btn" href="{{ route('enrutador.bitacora') }}">Consultar bitácora</a>
    @elseif(auth()->user()->role === 'administrador')
        <p>Perfil de administración general del sistema.</p>
    @elseif(auth()->user()->role === 'encuestador')
        <p>Perfil de encuestador. El módulo de asignación de rutas corresponde a una etapa posterior.</p>
    @elseif(auth()->user()->role === 'calidad')
        <p>Perfil de calidad. El módulo de revisión corresponde a una etapa posterior.</p>
    @endif
</div>
@endsection
