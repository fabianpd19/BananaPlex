<?php
function obtenerSolicitudes($pdo)
{
    $stmt = $pdo->query('
        SELECT s.id, s.cantidad, s.precio_ofrecido, s.tipo, c.nombre1 AS cliente_nombre, p.nombre AS producto_nombre
        FROM solicitudes s
        JOIN clientes c ON s.cliente_id = c.id
        JOIN productos p ON s.producto_id = p.id
        WHERE s.estado = \'pendiente\'
    ');
    return $stmt->fetchAll();
}
