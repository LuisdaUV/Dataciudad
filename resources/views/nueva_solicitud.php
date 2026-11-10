<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Captura de Solicitud - Ventanilla</title>
    <!-- Leaflet CSS para el Mapa -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <style>
        #mapa { height: 350px; width: 100%; margin-top: 10px; border-radius: 8px; }
        .form-container { width: 90%; max-width: 800px; margin: 20px auto; font-family: Arial, sans-serif; }
        .grid { display: grid; grid-template-columns: 1fr 1fr; gap: 15px; }
        .full-width { grid-column: span 2; }
    </style>
</head>
<body>
<div class="form-container">
    <h2>Registrar Nueva Solicitud de Encuesta</h2>
    <form action="../../controllers/VentanillaController.php" method="POST">
        <div class="grid">
            <div>
                <label>Nombres:</label>
                <input type="text" name="nombres" required class="full-width">
            </div>
            <div>
                <label>Apellidos:</label>
                <input type="text" name="apellidos" required class="full-width">
            </div>
            <div>
                <label>Teléfono Celular:</label>
                <input type="tel" name="celular" required class="full-width">
            </div>
            <div>
                <label>División Sectorial (Cali):</label>
                <select name="comuna_corregimiento" required class="full-width">
                    <optgroup label="Comunas Urbanas">
                        <option value="Comuna 1">Comuna 1</option>
                        <option value="Comuna 6">Comuna 6</option>
                        <option value="Comuna 7">Comuna 7</option>
                        <option value="Comuna 13">Comuna 13</option>
                        <option value="Comuna 14">Comuna 14</option>
                        <option value="Comuna 17">Comuna 17 (Oficina Principal)</option>
                        <option value="Comuna 20">Comuna 20</option>
                        <option value="Comuna 21">Comuna 21</option>
                    </optgroup>
                    <optgroup label="Corregimientos Rurales">
                        <option value="Navarro">Navarro</option>
                        <option value="El Hormiguero">El Hormiguero</option>
                        <option value="Pance">Pance</option>
                        <option value="La Buitrera">La Buitrera</option>
                        <option value="Felidia">Felidia</option>
                    </optgroup>
                </select>
            </div>
            <div>
                <label>Barrio / Vereda:</label>
                <input type="text" name="barrio" required class="full-width">
            </div>
            <div>
                <label>Dirección:</label>
                <input type="text" name="direccion" required class="full-width">
            </div>
        </div>

        <div class="full-width" style="margin-top: 15px;">
            <label><strong>Georreferenciación (Haga clic en el mapa para fijar la ubicación exactas):</strong></label>[cite: 3]
            <div id="mapa"></div>
            <input type="hidden" id="latitud" name="latitud" required>
            <input type="hidden" id="longitud" name="longitud" required>
        </div>

        <button type="submit" style="margin-top:20px; padding:10px 20px; background:#0056b3; color:white; border:none; border-radius:4px;">
            Guardar Solicitud
        </button>
    </form>
</div>

<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
    // Inicializar mapa centrado en Santiago de Cali
    const map = L.map('mapa').setView([3.4516, -76.5320], 12);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    let marker;

    // Capturar coordenadas al hacer clic en el mapa[cite: 3]
    map.on('click', function(e) {
        const lat = e.latlng.lat;
        const lng = e.latlng.lng;

        document.getElementById('latitud').value = lat;
        document.getElementById('longitud').value = lng;

        if (marker) {
            marker.setLatLng(e.latlng);
        } else {
            marker = L.marker(e.latlng).addTo(map);
        }
    });
</script>
</body>
</html>