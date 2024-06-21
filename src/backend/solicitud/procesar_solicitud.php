<?php
// Verificar que se haya enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Incluir archivo de configuración de la base de datos
    require_once '../config.php';

    // Obtener los datos del formulario
    $producto_id = $_POST['producto_id'];
    $cantidad = $_POST['cantidad'];
    $precio_ofrecido = $_POST['precio_ofrecido'];
    $tipo = $_POST['tipo'];
    $empleado_id = $_POST['empleado_id'];

    // Buscar al cliente por su cédula para obtener su ID
    $cedula_cliente = $_POST['cedula_cliente'];
    $query_cliente = "SELECT id FROM clientes WHERE cedula = :cedula_cliente";
    $stmt_cliente = $pdo->prepare($query_cliente);
    $stmt_cliente->bindParam(':cedula_cliente', $cedula_cliente);
    $stmt_cliente->execute();
    $cliente = $stmt_cliente->fetch(PDO::FETCH_ASSOC);

    if ($cliente) {
        $cliente_id = $cliente['id'];

        try {
            // Preparar la consulta SQL para insertar la solicitud
            $query = "INSERT INTO solicitudes (cliente_id, usuario_id, producto_id, cantidad, precio_ofrecido, estado, tipo, empleado_id)
                      VALUES (:cliente_id, :usuario_id, :producto_id, :cantidad, :precio_ofrecido, 'pendiente', :tipo, :empleado_id)";
            $stmt = $pdo->prepare($query);

            // Suponiendo que el usuario_id viene de la sesión actual
            $usuario_id = 1; // Suponiendo que obtienes esto de la sesión del usuario actual

            // Bind de parámetros
            $stmt->bindParam(':cliente_id', $cliente_id);
            $stmt->bindParam(':usuario_id', $usuario_id);
            $stmt->bindParam(':producto_id', $producto_id);
            $stmt->bindParam(':cantidad', $cantidad);
            $stmt->bindParam(':precio_ofrecido', $precio_ofrecido);
            $stmt->bindParam(':tipo', $tipo);
            $stmt->bindParam(':empleado_id', $empleado_id);

            // Ejecutar consulta
            if ($stmt->execute()) {
                echo "Solicitud enviada correctamente.";
            } else {
                echo "Error al enviar la solicitud.";
            }
        } catch (PDOException $e) {
            die("Error al procesar la solicitud: " . $e->getMessage());
        }
    } else {
        echo "Cliente no encontrado.";
    }
}
