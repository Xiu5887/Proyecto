<?php
session_start();

// Verificar si el usuario está logueado
if (!isset($_SESSION['estudiante_id'])) {
    // Si no está logueado, redirigir al login
    header("Location: ../html/login.html");
    exit;
}
?>
