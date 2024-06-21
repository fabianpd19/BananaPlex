<?php
// Función para obtener todos los clientes con información extendida
function obtenerClientes($pdo)
{
    $query = "SELECT c.id, c.nombre1, c.nombre2, c.apellido1, c.apellido2, c.direccion, c.telefono, c.cedula, c.fecha_registro, e.nombre AS nombre_empresa, p.nombre AS nombre_provincia
              FROM clientes c
              LEFT JOIN empresas e ON c.empresa_id = e.id
              LEFT JOIN provincias p ON p.id = c.provincia_id";

    try {
        $stmt = $pdo->query($query);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    } catch (PDOException $e) {
        die("Error en la consulta: " . $e->getMessage());
    }
}
