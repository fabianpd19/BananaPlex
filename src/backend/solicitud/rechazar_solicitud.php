<?php
require_once '../config.php';

if (isset($_GET['id'])) {
    $solicitud_id = $_GET['id'];

    try {
        // Actualizar el estado de la solicitud
        $stmt = $pdo->prepare('
            UPDATE solicitudes SET estado = \'rechazada\' WHERE id = ?
        ');
        $stmt->execute([$solicitud_id]);
    } catch (PDOException $e) {
        die("Error al rechazar la solicitud: " . $e->getMessage());
    }
}

header('Location: ../../solicitud.php');
exit;
