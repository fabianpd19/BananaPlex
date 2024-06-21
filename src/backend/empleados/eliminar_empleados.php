<?php
require_once '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];

    try {
        // Iniciar transacción
        $pdo->beginTransaction();

        // Obtener el usuario_id asociado con el empleado
        $sqlSelect = "SELECT usuario_id FROM empleados WHERE id = :id";
        $stmtSelect = $pdo->prepare($sqlSelect);
        $stmtSelect->execute([':id' => $id]);
        $usuario = $stmtSelect->fetch(PDO::FETCH_ASSOC);

        if ($usuario) {
            $usuario_id = $usuario['usuario_id'];

            // Eliminar el usuario (lo que también eliminará al empleado por la restricción ON DELETE CASCADE)
            $sqlDeleteUsuario = "DELETE FROM usuarios WHERE id = :usuario_id";
            $stmtDeleteUsuario = $pdo->prepare($sqlDeleteUsuario);
            $stmtDeleteUsuario->execute([':usuario_id' => $usuario_id]);
        }

        // Confirmar transacción
        $pdo->commit();

        header("Location: ../../empleados.php"); // Redirige a la página principal después de eliminar
    } catch (PDOException $e) {
        // Revertir transacción en caso de error
        $pdo->rollBack();
        die("Error al eliminar empleado: " . $e->getMessage());
    }
}
?>
