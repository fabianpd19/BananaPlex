<?php
require_once '../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $accion = $_POST['accion'];

    try {
        // Iniciar la transacción
        $pdo->beginTransaction();

        if ($accion === 'aprobar') {
            // Obtener detalles de la solicitud
            $stmt = $pdo->prepare('SELECT * FROM solicitudes WHERE id = ?');
            $stmt->execute([$id]);
            $solicitud = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($solicitud) {
                // Lógica para aprobar la solicitud (actualizar inventario, registrar transacción, etc.)
                $stmt = $pdo->prepare('UPDATE solicitudes SET estado = "aprobada" WHERE id = ?');
                $stmt->execute([$id]);
            }
        } elseif ($accion === 'rechazar') {
            // Lógica para rechazar la solicitud
            $stmt = $pdo->prepare('UPDATE solicitudes SET estado = "rechazada" WHERE id = ?');
            $stmt->execute([$id]);
        }

        // Confirmar la transacción
        $pdo->commit();
    } catch (PDOException $e) {
        // Revertir la transacción si hay un error
        $pdo->rollBack();
        die("Error en la consulta: " . $e->getMessage());
    }

    // Redirigir de vuelta a la página de solicitudes
    header('Location: ../../solicitudes.php');
    exit;
}
