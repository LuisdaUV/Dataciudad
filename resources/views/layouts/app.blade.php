<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'DataCiudad')</title>
    <style>
        *{box-sizing:border-box}body{margin:0;font-family:Arial,sans-serif;background:#f1f5f9;color:#172b4d}
        header{background:#082f49;color:#fff;padding:16px 5%;display:flex;justify-content:space-between;align-items:center;gap:15px;flex-wrap:wrap}
        header a{color:#fff;text-decoration:none;margin-right:16px}.container{max-width:1100px;margin:32px auto;padding:0 18px}
        .card{background:#fff;padding:26px;border-radius:16px;box-shadow:0 8px 30px #0f172a0d}
        input,select{width:100%;padding:12px;border:1px solid #cbd5e1;border-radius:8px;margin:6px 0 15px}
        label{font-weight:600}.btn{display:inline-block;background:#0e7490;color:white;padding:11px 17px;border:0;border-radius:8px;text-decoration:none;cursor:pointer}
        .btn-secondary{background:#334155}table{width:100%;border-collapse:collapse;background:white;margin-top:18px}th,td{padding:11px;border-bottom:1px solid #e2e8f0;text-align:left;font-size:14px}
        th{background:#e2f3f7}.alert{padding:12px;border-radius:8px;margin:12px 0}.success{background:#dcfce7;color:#166534}.error{color:#b91c1c;font-size:13px}
        #mapa{height:360px;border-radius:10px;margin:10px 0 16px}.muted{color:#64748b}
    </style>
    @stack('styles')
</head>
<body>
<header>
    <div><strong>DataCiudad</strong> <span class="muted" style="color:#cbd5e1">| Gestión de encuestas</span></div>
    @auth
        <nav>
            <a href="{{ route('dashboard') }}">Inicio</a>
            @if(auth()->user()->role === 'ventanilla')<a href="{{ route('ventanilla.solicitudes.create') }}">Nueva solicitud</a>@endif
            @if(auth()->user()->role === 'enrutador')<a href="{{ route('enrutador.bitacora') }}">Bitácora diaria</a>@endif
            <form method="POST" action="{{ route('logout') }}" style="display:inline">@csrf<button class="btn btn-secondary" type="submit">Cerrar sesión</button></form>
        </nav>
    @endauth
</header>
<div class="container">@yield('content')</div>
@stack('scripts')
</body>
</html>
