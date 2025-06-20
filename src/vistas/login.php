<?php
require_once __DIR__ . '/../../conexion.php';
session_start();

$error_message = '';

// Si el usuario ya está logueado, redirigir a inicio
if (isset($_SESSION['id'])) {
    header('Location: Inicio.php');
    exit();
}

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
            header('Location: Inicio.php');
            exit();
        } else {
            $error_message = 'Carnet o contraseña incorrectos.';
        }
    } else {
        $error_message = 'Ambos campos son obligatorios.';
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Inicia sesión en MiPortafolioDigital" />
    <title>Login | MiPortafolioDigital</title>
    <link rel="stylesheet" href="../../asset/css/usuarios.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
    <main class="container">
        <header>
            <h1 class="titulo">MiPortafolioDigital</h1>
            <p class="subtitulo">Bienvenido de nuevo. Accede a tu cuenta.</p>
        </header>

        <section class="form-section">
            <h2 class="form-title">Iniciar Sesión</h2>

            <?php if (!empty($error_message)): ?>
                <div class="error-banner" style="background-color: #ffdddd; border: 1px solid #f44336; color: #f44336; padding: 15px; margin-bottom: 20px; border-radius: 5px; text-align: center;">
                    <p><?php echo htmlspecialchars($error_message); ?></p>
                </div>
            <?php endif; ?>

            <form action="login.php" method="POST" class="login-form">
                <div class="input-group">
                    <i class="fas fa-id-card input-icon"></i>
                    <input 
                        type="text" 
                        name="carnet" 
                        id="carnet"
                        placeholder="Número de Carnet" 
                        required 
                        autocomplete="username"
                    />
                </div>

                <div class="input-group">
                    <i class="fas fa-lock input-icon"></i>
                    <input 
                        type="password" 
                        name="contrasena" 
                        id="contrasena"
                        placeholder="Contraseña" 
                        required 
                        autocomplete="current-password"
                    />
                </div>

                <button type="submit" class="submit-btn">
                    <i class="fas fa-sign-in-alt"></i>
                    Acceder
                </button>
            </form>

            <div class="links-section">
                <a href="registro.php" class="linkSecundario">
                    <i class="fas fa-user-plus"></i>
                    ¿No tienes una cuenta? Regístrate
                </a>
            </div>
        </section>
    </main>
</body>
</html>
