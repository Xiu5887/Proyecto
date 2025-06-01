<?php
require_once 'conexion.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $carnet = trim($_POST['carnet'] ?? '');
    $contrasena = $_POST['contrasena'] ?? '';

    if ($carnet && $contrasena) {
        $sql = "SELECT * FROM estudiantes WHERE carnet = ? LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$carnet]);
        $usuario = $stmt->fetch();
        if ($usuario && password_verify($contrasena, $usuario['contrasena'])) {
            $_SESSION['id'] = $usuario['id'];
            $_SESSION['nombres'] = $usuario['nombres'];
            $_SESSION['apellidos'] = $usuario['apellidos'];
            $_SESSION['carnet'] = $usuario['carnet'];
            header('Location: ../html/inicio.php');
            exit();
        } else {
            header('Location: ../html/login.html?error=credenciales');
            exit();
        }
    } else {
        header('Location: ../html/login.html?error=campos');
        exit();
    }
} else {
    header('Location: ../html/login.html');
    exit();
}
?>
