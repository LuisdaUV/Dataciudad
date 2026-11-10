<?php
require_once __DIR__ . '/../config/database.php';

class EnrutadorController {
    public function obtenerBitacoraDia() {
        $database = new Database();
        $db = $database->getConnection();

        // Obtener todas las solicitudes registradas en la fecha actual
        $query = "SELECT s.id, s.nombres, s.apellidos, s.barrio, s.comuna_corregimiento, 
                         s.direccion, s.celular, s.latitud, s.longitud, s.fecha_registro,
                         p.nombre AS punto_atencion
                  FROM solicitudes s
                  INNER JOIN puntos_atencion p ON s.punto_atencion_id = p.id
                  WHERE DATE(s.fecha_registro) = CURDATE()
                  ORDER BY s.fecha_registro DESC";

        $stmt = $db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>