<?php
require_once 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombres = trim($_POST['nombres'] ?? '');
    $apellidos = trim($_POST['apellidos'] ?? '');
    $carnet = trim($_POST['carnet'] ?? '');
    $contrasena = $_POST['contrasena'] ?? '';

    if ($nombres && $apellidos && $carnet && $contrasena) {
        $hash = password_hash($contrasena, PASSWORD_DEFAULT);
        $sql = "INSERT INTO estudiantes (nombres, apellidos, carnet, contrasena) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        try {
            $stmt->execute([$nombres, $apellidos, $carnet, $hash]);
            header('Location: ../html/login.html?registro=exitoso');
            exit();
        } catch (PDOException $e) {
            header('Location: ../html/Registro.html?error=duplicado');
            exit();
        }
    } else {
        header('Location: ../html/Registro.html?error=campos');
        exit();
    }
} else {
    header('Location: ../html/Registro.html');
    exit();
}
?>