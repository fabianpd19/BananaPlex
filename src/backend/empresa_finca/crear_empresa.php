<?php
require_once '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];

    $sql = "INSERT INTO empresas (nombre, direccion, telefono, email) 
            VALUES (:nombre, :direccion, :telefono, :email)";

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':nombre' => $nombre,
            ':direccion' => $direccion,
            ':telefono' => $telefono,
            ':email' => $email
        ]);
        header("Location: ../../index.html");
    } catch (PDOException $e) {
        die("Error al crear la empresa/finca: " . $e->getMessage());
    }
}
?>