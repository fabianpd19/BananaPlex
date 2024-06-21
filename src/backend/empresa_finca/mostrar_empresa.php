<?php
// Función para obtener todas las empresas con información extendida
function obtenerEmpresas($pdo)
{
    $query = "SELECT e.id, e.nombre AS nombre_empresa, e.direccion, e.telefono, e.email
              FROM empresas e";

    try {
        $stmt = $pdo->query($query);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    } catch (PDOException $e) {
        die("Error en la consulta: " . $e->getMessage());
    }
}
?>
