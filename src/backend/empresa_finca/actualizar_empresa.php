<?php
require_once '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nombre = strtoupper($_POST['nombre']); // Convertir el nombre a mayúsculas
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];

    try {
        $sql = "UPDATE empresas SET nombre = :nombre, direccion = :direccion, telefono = :telefono, email = :email WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'id' => $id,
            'nombre' => $nombre,
            'direccion' => $direccion,
            'telefono' => $telefono,
            'email' => $email
        ]);
        header("Location: ../../empresas.php"); // Redirige a la página principal después de actualizar
    } catch (PDOException $e) {
        die("Error al actualizar la empresa/finca: " . $e->getMessage());
    }
}
?>
