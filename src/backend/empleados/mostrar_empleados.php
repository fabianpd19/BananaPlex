<?php
// Función para obtener todos los empleados con información extendida
function obtenerEmpleados($pdo)
{
    $query = "SELECT e.id, e.usuario_id, u.nombre AS nombre_usuario, u.correo, u.rol_id, e.nombre1, e.nombre2, e.apellido1, e.apellido2, e.direccion, e.cedula, e.fecha_registro, p.nombre AS nombre_provincia
              FROM empleados e
              LEFT JOIN usuarios u ON e.usuario_id = u.id
              LEFT JOIN provincias p ON e.provincia_id = p.id";

    try {
        $stmt = $pdo->query($query);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    } catch (PDOException $e) {
        die("Error en la consulta: " . $e->getMessage());
    }
}
?>
