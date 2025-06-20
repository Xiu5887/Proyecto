<?php
require_once __DIR__ . '/../../conexion.php';
session_start();

// Si no hay sesión activa, redirigir al index
if (!isset($_SESSION['id'])) {
    header('Location: ../../index.php');
    exit;
}

$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $contrasena = $_POST['contrasena'] ?? '';
    $id = $_SESSION['id'];
    $sql = "SELECT contrasena FROM estudiantes WHERE id = ? LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);
    $usuario = $stmt->fetch();

    if ($usuario && password_verify($contrasena, $usuario['contrasena'])) {
        // Contraseña correcta, redirigir al panel principal
        header('Location: Inicio.php');
        exit;
    } else {
        $error_message = 'Contraseña incorrecta. Inténtalo de nuevo.';
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Verificación de sesión | MiPortafolioDigital" />
    <title>Verificar Sesión | MiPortafolioDigital</title>
    <link rel="stylesheet" href="/1/asset/css/usuarios.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <main class="container">
        <header>
            <h1 class="titulo">Verificación de Sesión</h1>
            <p class="subtitulo">Por seguridad, confirma tu contraseña para continuar.</p>
        </header>
        <section class="form-section">
            <form action="verificar.php" method="POST" class="login-form">
                <?php if (!empty($error_message)): ?>
                    <div class="error-banner" style="background-color: #ffdddd; border: 1px solid #f44336; color: #f44336; padding: 15px; margin-bottom: 20px; border-radius: 5px; text-align: center;">
                        <p><?php echo htmlspecialchars($error_message); ?></p>
                    </div>
                <?php endif; ?>
                <div class="input-group">
                    <i class="fas fa-lock input-icon"></i>
                    <input 
                        type="password" 
                        name="contrasena" 
                        id="contrasena"
                        placeholder="Contraseña actual" 
                        required 
                        autocomplete="current-password"
                    />
                </div>
                <button type="submit" class="submit-btn">
                    <i class="fas fa-shield-alt"></i>
                    Verificar y continuar
                </button>
            </form>
            <div class="links-section" style="margin-top: 20px;">
                <a href="../controlador/logout.php" class="linkSecundario">
                    <i class="fas fa-sign-out-alt"></i> Cerrar sesión
                </a>
            </div>
        </section>
    </main>
</body>
</html>
