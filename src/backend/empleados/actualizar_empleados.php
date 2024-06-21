<?php
require_once '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nombre1 = strtoupper($_POST['nombre1']); // Convertir el primer nombre a mayúsculas
    $nombre2 = strtoupper($_POST['nombre2']); // Convertir el segundo nombre a mayúsculas
    $apellido1 = strtoupper($_POST['apellido1']); // Convertir el primer apellido a mayúsculas
    $apellido2 = strtoupper($_POST['apellido2']); // Convertir el segundo apellido a mayúsculas
    $cedula = $_POST['cedula']; // Capturar el valor de cedula
    $direccion = $_POST['direccion'];
    $provincia_id = $_POST['provincia'];

    try {
        // Modificamos la consulta para incluir la actualización del campo cedula
        $sql = "UPDATE empleados 
                SET nombre1 = :nombre1, nombre2 = :nombre2, apellido1 = :apellido1, apellido2 = :apellido2, cedula = :cedula, direccion = :direccion, provincia_id = :provincia_id 
                WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'id' => $id,
            'nombre1' => $nombre1,
            'nombre2' => $nombre2,
            'apellido1' => $apellido1,
            'apellido2' => $apellido2,
            'cedula' => $cedula, // Agregar el valor de cedula al array de parámetros
            'direccion' => $direccion,
            'provincia_id' => $provincia_id
        ]);
        header("Location: ../../empleados.php"); // Redirige a la página principal después de actualizar
    } catch (PDOException $e) {
        die("Error al actualizar empleado: " . $e->getMessage());
    }
}
?>
