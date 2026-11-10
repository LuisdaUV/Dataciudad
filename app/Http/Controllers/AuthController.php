<?php
session_start();
require_once __DIR__ . '/../config/database.php';

class AuthController {
    public function login($email, $password) {
        $database = new Database();
        $db = $database->getConnection();

        $query = "SELECT u.id, u.nombre, u.password, u.punto_atencion_id, r.nombre AS rol 
                  FROM usuarios u 
                  INNER JOIN roles r ON u.rol_id = r.id 
                  WHERE u.email = :email LIMIT 1";
        
        $stmt = $db->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if (password_verify($password, $row['password'])) {
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['user_nombre'] = $row['nombre'];
                $_SESSION['user_rol'] = $row['rol'];
                $_SESSION['punto_atencion_id'] = $row['punto_atencion_id'];

                // Redirección según el rol de usuario
                switch ($row['rol']) {
                    case 'ventanilla':
                        header("Location: /views/ventanilla/nueva_solicitud.php");
                        break;
                    case 'enrutador':
                        header("Location: /views/enrutador/bitacora.php");
                        break;
                    default:
                        header("Location: /views/dashboard.php");
                        break;
                }
                exit;
            }
        }
        return "Credenciales inválidas";
    }
}
?>