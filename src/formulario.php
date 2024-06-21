<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Solicitud</title>
</head>

<body>
    <h2>Formulario de Solicitud</h2>
    <form action="backend/solicitud/procesar_solicitud.php" method="POST">
        <label for="tipo">Tipo de Solicitud:</label>
        <select name="tipo" id="tipo">
            <option value="compra">Compra</option>
            <option value="venta">Venta</option>
        </select><br><br>

        <label for="producto_id">Producto:</label>
        <select name="producto_id" id="producto_id">
            <?php
            // Incluir archivo de configuración de la base de datos
            require_once 'backend/config.php';

            // Consulta para obtener los productos disponibles
            $query = "SELECT id, nombre FROM productos";
            $stmt = $pdo->prepare($query);
            $stmt->execute();
            $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Mostrar opciones de productos en el select
            foreach ($productos as $producto) {
                echo "<option value='{$producto['id']}'>{$producto['nombre']}</option>";
            }
            ?>
        </select><br><br>

        <label for="cantidad">Cantidad:</label>
        <input type="number" name="cantidad" id="cantidad" required><br><br>

        <label for="precio_ofrecido">Precio Ofrecido:</label>
        <input type="number" step="0.01" name="precio_ofrecido" id="precio_ofrecido" required><br><br>

        <!-- Consulta para buscar al cliente por su cédula -->
        <label for="cedula_cliente">Cédula del Cliente:</label>
        <input type="text" name="cedula_cliente" id="cedula_cliente" required>
        <button type="button" onclick="buscarCliente()">Buscar</button><br><br>

        <!-- Select para seleccionar al empleado responsable -->
        <label for="empleado_id">Empleado Responsable:</label>
        <select name="empleado_id" id="empleado_id">
            <?php
            // Consulta para obtener la lista de empleados
            $query_empleados = "SELECT id, CONCAT(nombre1, ' ', IFNULL(nombre2, ''), ' ', apellido1, ' ', apellido2) AS nombre_completo FROM empleados";
            $stmt_empleados = $pdo->prepare($query_empleados);
            $stmt_empleados->execute();
            $empleados = $stmt_empleados->fetchAll(PDO::FETCH_ASSOC);

            // Mostrar opciones de empleados en el select
            foreach ($empleados as $empleado) {
                echo "<option value='{$empleado['id']}'>{$empleado['nombre_completo']}</option>";
            }
            ?>
        </select><br><br>

        <input type="submit" value="Enviar Solicitud">
    </form>

    <script>
        // Función para buscar al cliente por su cédula
        function buscarCliente() {
            var cedula = document.getElementById('cedula_cliente').value;
            // Realizar la búsqueda del cliente por su cédula usando AJAX u otra técnica
            // Aquí podrías implementar una llamada AJAX para buscar y mostrar los datos del cliente
            // Puedes adaptar esta parte según la forma en que manejes la búsqueda de clientes en tu aplicación
            alert('Implementa la búsqueda del cliente por su cédula aquí');
        }
    </script>
</body>

</html>