@extends('layouts.app')
@section('title', 'Registrar solicitud | DataCiudad')
@push('styles')<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">@endpush
@section('content')
<div class="card">
    <h1>Registrar nueva solicitud de encuesta</h1>
    <p class="muted">Completa los datos del usuario y selecciona en el mapa la ubicación de la visita.</p>
    @if(session('success'))<div class="alert success">{{ session('success') }}</div>@endif
    @if($errors->any())<div class="alert" style="background:#fee2e2;color:#991b1b">Revisa los campos marcados. {{ $errors->first() }}</div>@endif
    <form method="POST" action="{{ route('ventanilla.solicitudes.store') }}">@csrf
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(230px,1fr));gap:0 18px">
            <div><label>Nombres</label><input name="nombres" value="{{ old('nombres') }}" required maxlength="120"></div>
            <div><label>Apellidos</label><input name="apellidos" value="{{ old('apellidos') }}" required maxlength="120"></div>
            <div><label>Celular</label><input name="celular" type="tel" value="{{ old('celular') }}" required maxlength="30"></div>
            <div><label>Barrio / Vereda</label><input name="barrio" value="{{ old('barrio') }}" required maxlength="120"></div>
            <div><label>Comuna / Corregimiento</label>
                <select name="comuna_corregimiento" required>
                    <option value="">Selecciona una opción</option>
                    @foreach(['Comuna 1','Comuna 6','Comuna 7','Comuna 13','Comuna 14','Comuna 17','Comuna 20','Comuna 21','Navarro','El Hormiguero','Pance','La Buitrera','Felidia'] as $sector)
                        <option value="{{ $sector }}" @selected(old('comuna_corregimiento') === $sector)>{{ $sector }}</option>
                    @endforeach
                </select>
            </div>
            <div><label>Dirección</label><input name="direccion" value="{{ old('direccion') }}" required maxlength="255"></div>
            <div><label>Punto de atención donde se radica</label>
                <select name="punto_atencion" required>
                    <option value="">Selecciona el punto</option>
                    @foreach(['Comuna 1','Comuna 6','Comuna 7','Comuna 13','Comuna 14','Comuna 17 - Oficina principal','Comuna 20','Comuna 21'] as $punto)
                        <option value="{{ $punto }}" @selected(old('punto_atencion') === $punto)>{{ $punto }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <h3>Georreferenciación de la solicitud</h3>
        <p class="muted">Haz clic sobre el mapa para fijar la ubicación. Las coordenadas se guardarán con la solicitud.</p>
        <div id="mapa"></div>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:15px">
            <div><label>Latitud</label><input id="latitud" name="latitud" value="{{ old('latitud') }}" readonly required></div>
            <div><label>Longitud</label><input id="longitud" name="longitud" value="{{ old('longitud') }}" readonly required></div>
        </div>
        <button class="btn" type="submit">Guardar solicitud</button>
    </form>
</div>
@endsection
@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const map = L.map('mapa').setView([3.4516, -76.5320], 12);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { attribution: '&copy; OpenStreetMap contributors' }).addTo(map);
    let marker = null;
    const latInput = document.getElementById('latitud');
    const lngInput = document.getElementById('longitud');
    function placeMarker(lat, lng) {
        latInput.value = Number(lat).toFixed(7);
        lngInput.value = Number(lng).toFixed(7);
        if (marker) marker.setLatLng([lat, lng]);
        else marker = L.marker([lat, lng]).addTo(map);
    }
    map.on('click', function (event) { placeMarker(event.latlng.lat, event.latlng.lng); });
    if (latInput.value && lngInput.value) {
        const lat = Number(latInput.value), lng = Number(lngInput.value);
        if (Number.isFinite(lat) && Number.isFinite(lng)) { placeMarker(lat, lng); map.setView([lat, lng], 16); }
    }
});
</script>
@endpush
