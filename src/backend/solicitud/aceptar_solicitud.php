<?php
require_once '../config.php';

if (isset($_GET['id'])) {
    $solicitud_id = $_GET['id'];

    try {
        // Iniciar transacción
        $pdo->beginTransaction();

        // Obtener la solicitud
        $stmt = $pdo->prepare('
            SELECT * FROM solicitudes WHERE id = ?
        ');
        $stmt->execute([$solicitud_id]);
        $solicitud = $stmt->fetch();

        if ($solicitud) {
            // Insertar en la tabla de transacciones
            $stmt = $pdo->prepare('
                INSERT INTO transacciones (cliente_id, producto_id, cantidad, precio_ofrecido, tipo)
                VALUES (?, ?, ?, ?, ?)
            ');
            $stmt->execute([
                $solicitud['cliente_id'],
                $solicitud['producto_id'],
                $solicitud['cantidad'],
                $solicitud['precio_ofrecido'],
                $solicitud['tipo']
            ]);

            // Actualizar el estado de la solicitud
            $stmt = $pdo->prepare('
                UPDATE solicitudes SET estado = \'aprobada\' WHERE id = ?
            ');
            $stmt->execute([$solicitud_id]);

            // Confirmar transacción
            $pdo->commit();
        }
    } catch (PDOException $e) {
        // Revertir transacción en caso de error
        $pdo->rollBack();
        die("Error al aceptar la solicitud: " . $e->getMessage());
    }
}

header('Location: ../../solicitud.php');
exit;
