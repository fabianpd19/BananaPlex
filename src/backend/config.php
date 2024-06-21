<?php
// $host = '192.168.1.18'; // Cambia esto por la dirección de tu servidor PostgreSQL
// $host = '10.241.0.67'; // Cambia esto por la dirección de tu servidor PostgreSQL
// $host = '10.241.0.56'; // Cambia esto por la dirección de tu servidor PostgreSQL
$host = '192.168.0.7'; // Cambia esto por la dirección de tu servidor PostgreSQL
$dbname = 'BananaPlex2'; // Nombre de tu base de datos
$user = 'Grupo3'; // Usuario de la base de datos
$password = 'gestiongrupo3'; // Contraseña del usuario

try {
    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Conexión exitosa";
} catch (PDOException $e) {
    die("Error: No se pudo conectar a la base de datos " . $e->getMessage());
}
