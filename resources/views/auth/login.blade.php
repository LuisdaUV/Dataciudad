<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Iniciar sesión | DataCiudad</title>
<style>
*{box-sizing:border-box}body{margin:0;min-height:100vh;display:grid;place-items:center;padding:20px;font-family:Arial,sans-serif;background:linear-gradient(135deg,#071b35,#123f68,#167d91)}
.login{background:white;width:100%;max-width:430px;padding:38px;border-radius:20px;box-shadow:0 24px 70px #00132666}h1{color:#102a43;margin-bottom:5px}label{display:block;font-weight:bold;margin:17px 0 7px}input{width:100%;padding:13px;border:1px solid #cbd5e1;border-radius:9px}button{width:100%;margin-top:22px;padding:14px;background:#0e7490;color:white;border:0;border-radius:9px;font-weight:bold;cursor:pointer}.error{color:#b91c1c;font-size:13px;margin-top:6px}.hint{font-size:12px;color:#64748b}
</style>
</head><body>
<main class="login">
<h1>DataCiudad</h1><p>Sistema de gestión de encuestas</p><h2>Iniciar sesión</h2>
@if($errors->any())<div class="error">{{ $errors->first() }}</div>@endif
<form method="POST" action="{{ route('login.submit') }}">@csrf
<label for="email">Correo electrónico</label><input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
<label for="password">Contraseña</label><input id="password" type="password" name="password" required>
<button type="submit">Ingresar</button></form>
<p class="hint">Acceso exclusivo para personal autorizado.</p>
</main></body></html>
