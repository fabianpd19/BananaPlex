<?php
// login.php

require 'config.php'; // Incluir el archivo de configuración

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST['email'];
    $contraseña = $_POST['password'];

    // Validar correo electrónico
    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        die("Correo electrónico no es válido.");
    }

    // Preparar consulta SQL para buscar el usuario
    $stmt = $pdo->prepare("SELECT id, nombre, contraseña FROM usuarios WHERE correo = :correo");
    $stmt->bindParam(':correo', $correo);
    $stmt->execute();

    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario && $contraseña === $usuario['contraseña']) {
        // Contraseña verificada, iniciar sesión
        session_start();
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['nombre'] = $usuario['nombre'];

        // Redirigir a la página de bienvenida
        header("Location: ../index.php");
    } else {
        // Error de autenticación
        header("Location: ../login.html");
    }
}
