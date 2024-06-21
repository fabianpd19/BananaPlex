<?php
// Función para obtener todos los productos
function obtenerProductos($pdo)
{
    $query = "SELECT p.id, p.nombre, p.descripcion, p.precio
              FROM productos p";

    try {
        $stmt = $pdo->query($query);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    } catch (PDOException $e) {
        die("Error en la consulta: " . $e->getMessage());
    }
}
