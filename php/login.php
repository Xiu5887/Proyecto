<?php
session_start();

// Incluir archivo de configuración
require_once 'config.php';

// Obtener datos del formulario
$nombre = $_POST['nombre'];
$contrasena = $_POST['contrasena'];

// Buscar el estudiante
$sql = "SELECT * FROM estudiantes WHERE nombre = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $nombre);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {
    $estudiante = $resultado->fetch_assoc();
    
    if (password_verify($contrasena, $estudiante['contrasena'])) {
        // Guardar datos de sesión
        $_SESSION['estudiante_id'] = $estudiante['id'];
        $_SESSION['nombre'] = $estudiante['nombre'];
        $_SESSION['apellido'] = $estudiante['apellido'];
        $_SESSION['matricula'] = $estudiante['matricula'];
        
        // Redireccionar a la página de inicio
        header("Location: ../html/Inicio.html");
        exit;
    } else {
        echo "<script>
            alert('⚠️ Contraseña incorrecta');
            window.location.href='../html/login.html';
        </script>";
    }
} else {
    echo "<script>
        alert('⚠️ Estudiante no encontrado');
        window.location.href='../html/login.html';
    </script>";
}

$stmt->close();
$conn->close();
?>
