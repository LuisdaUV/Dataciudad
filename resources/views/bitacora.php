<?php
session_start();
// Verificar sesión y rol de enrutador
if (!isset($_SESSION['user_rol']) || $_SESSION['user_rol'] !== 'enrutador') {
    header("Location: /views/auth/login.php");
    exit;
}

require_once '../../controllers/EnrutadorController.php';
$controller = new EnrutadorController();
$solicitudes = $controller->obtenerBitacoraDia();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Bitácora Diaria - Perfil Enrutador</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background-color: #0056b3; color: white; }
        tr:nth-child(even) { background-color: #f2f2f2; }
        .badge { background: #28a745; color: white; padding: 4px 8px; border-radius: 4px; font-size: 12px; }
    </style>
</head>
<body>
    <h2>Bitácora de Solicitudes Generadas Hoy (<?php echo date('Y-m-d'); ?>)</h2>[cite: 3]
    <p>Puntos de Atención Consolidados: Comunas 1, 6, 7, 13, 14, 17, 20, 21.</p>[cite: 3]

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Punto de Atención</th>
                <th>Usuario</th>
                <th>Teléfono</th>
                <th>Comuna / Corregimiento</th>
                <th>Barrio</th>
                <th>Dirección</th>
                <th>Coordenadas (Lat, Lng)</th>
                <th>Hora Registro</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($solicitudes) > 0): ?>
                <?php foreach ($solicitudes as $row): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><span class="badge"><?php echo htmlspecialchars($row['punto_atencion']); ?></span></td>
                        <td><?php echo htmlspecialchars($row['nombres'] . ' ' . $row['apellidos']); ?></td>
                        <td><?php echo htmlspecialchars($row['celular']); ?></td>
                        <td><?php echo htmlspecialchars($row['comuna_corregimiento']); ?></td>
                        <td><?php echo htmlspecialchars($row['barrio']); ?></td>
                        <td><?php echo htmlspecialchars($row['direccion']); ?></td>
                        <td><?php echo $row['latitud'] . ', ' . $row['longitud']; ?></td>
                        <td><?php echo date('H:i:s', strtotime($row['fecha_registro'])); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="9" style="text-align:center;">No hay solicitudes registradas el día de hoy.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>