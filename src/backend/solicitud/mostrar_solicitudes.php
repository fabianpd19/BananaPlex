<?php
function obtenerSolicitudes($pdo)
{
    $query = "SELECT * FROM obtener_solicitudes_pendientes();";

    try {
        $stmt = $pdo->query($query);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    } catch (PDOException $e) {
        die("Error en la consulta: " . $e->getMessage());
    }
}
