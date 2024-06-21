<?php
require_once '../config.php';

// Configurar la zona horaria adecuada para Ecuador
date_default_timezone_set('America/Guayaquil');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];

    // Validar precio y stock según tus requerimientos específicos
    if (!is_numeric($precio) || !is_numeric($stock)) {
        die("Error: El precio y el stock deben ser números.");
    }

    $fecha_registro = date('Y-m-d H:i:s');

    $sql = "INSERT INTO productos (nombre, descripcion, precio, stock) 
            VALUES (:nombre, :descripcion, :precio, :stock)";

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':nombre' => $nombre,
            ':descripcion' => $descripcion,
            ':precio' => $precio,
            ':stock' => $stock,
        ]);
        header("Location: ../../productos.php"); // Redirige a la página principal después de crear el producto
        exit();
    } catch (PDOException $e) {
        die("Error al crear producto: " . $e->getMessage());
    }
}
?>
