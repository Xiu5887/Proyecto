<?php
require_once __DIR__ . '/../../conexion.php';

$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombres = trim($_POST['nombres'] ?? '');
    $apellidos = trim($_POST['apellidos'] ?? '');
    $carnet = trim($_POST['carnet'] ?? '');
    $contrasena = $_POST['contrasena'] ?? '';

    if ($nombres && $apellidos && $carnet && $contrasena) {
        $sql_check = "SELECT id FROM estudiantes WHERE carnet = ? LIMIT 1";
        $stmt_check = $conn->prepare($sql_check);
        $stmt_check->execute([$carnet]);
        if ($stmt_check->fetch()) {
            $error_message = 'El número de carnet ya está registrado.';
        } else {
            $hash = password_hash($contrasena, PASSWORD_DEFAULT);
            $sql = "INSERT INTO estudiantes (nombres, apellidos, carnet, contrasena) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            try {
                $stmt->execute([$nombres, $apellidos, $carnet, $hash]);
                header('Location: login.php?registro=exitoso');
                exit();
            } catch (PDOException $e) {
                $error_message = 'Ocurrió un error inesperado al registrar.';
            }
        }
    } else {
        $error_message = 'Todos los campos son obligatorios.';
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Regístrate en MiPortafolioDigital y comienza a organizar tu vida académica" />
    <title>Registro | MiPortafolioDigital</title>
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
            <p class="subtitulo">Organiza tus evaluaciones y mejora tu rendimiento académico.</p>
        </header>

        <section class="form-section">
            <h2 class="form-title">Registro de Estudiante</h2>
            
            <?php if (!empty($error_message)): ?>
                <div class="error-banner" style="background-color: #ffdddd; border: 1px solid #f44336; color: #f44336; padding: 15px; margin-bottom: 20px; border-radius: 5px; text-align: center;">
                    <p><?php echo htmlspecialchars($error_message); ?></p>
                </div>
            <?php endif; ?>

            <form action="registro.php" method="POST" class="register-form">
                <div class="input-group">
                    <i class="fas fa-user input-icon"></i>
                    <input 
                        type="text" 
                        name="nombres" 
                        id="nombres"
                        placeholder="Nombres" 
                        required 
                        autocomplete="given-name"
                    />
                </div>

                <div class="input-group">
                    <i class="fas fa-user input-icon"></i>
                    <input 
                        type="text" 
                        name="apellidos" 
                        id="apellidos"
                        placeholder="Apellidos" 
                        required 
                        autocomplete="family-name"
                    />
                </div>

                <div class="input-group">
                    <i class="fas fa-id-card input-icon"></i>
                    <input 
                        type="text" 
                        name="carnet" 
                        id="carnet"
                        placeholder="Número de Carnet" 
                        required 
                        pattern="[0-9]+"
                        title="Por favor ingresa solo números"
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
                        autocomplete="new-password"
                        minlength="6"
                    />
                </div>

                <button type="submit" class="submit-btn">
                    <i class="fas fa-user-plus"></i>
                    Crear Cuenta
                </button>
            </form>

            <div class="links-section">
                <a href="login.php" class="linkSecundario">
                    <i class="fas fa-sign-in-alt"></i>
                    ¿Ya tienes una cuenta? Inicia sesión
                </a>
            </div>
        </section>
    </main>

    <script src="../../asset/javascript/animaciones.js"></script>
</body>
</html>
