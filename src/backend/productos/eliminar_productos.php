<?php
require_once '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];

    try {
        $sql = "DELETE FROM productos WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        header("Location: ../../productos.php"); // Redirige a la página principal después de eliminar
    } catch (PDOException $e) {
        die("Error al eliminar producto: " . $e->getMessage());
    }
}
