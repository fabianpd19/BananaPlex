<?php
// $host = 'db';
// $dbname = 'BananaPlex';
// $user = 'Grupo3';
// $password = 'gestiongrupo3';

$host = 'db';
$dbname = 'BananaPlex';
$user = 'Grupo3';
$password = 'gestiongrupo3';

try {
    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Conexión exitosa";
} catch (PDOException $e) {
    die("Error: No se pudo conectar a la base de datos " . $e->getMessage());
}
