<?php
// conexion.php - Conexión segura a la base de datos
// Usa require_once para evitar inclusiones múltiples

$host = 'localhost';
$db   = 'portafolio_digital';
$user = 'root'; // Cambia si tu usuario de MySQL es diferente
$pass = '';     // Cambia si tu contraseña de MySQL no está vacía
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

if (!isset($conn)) {
    try {
        $conn = new PDO($dsn, $user, $pass, $options);
    } catch (PDOException $e) {
        die('Error de conexión: ' . $e->getMessage());
    }
}
?>