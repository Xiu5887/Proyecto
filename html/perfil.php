<?php
require_once '../php/conexion.php';
session_start();
if (!isset($_SESSION['id'])) {
    header('Location: login.html');
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil | MiPortafolioDigital</title>
    <link rel="stylesheet" href="../css/estilo.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="app-container">
        <aside class="sidebar">
            <div class="sidebar-top">
                <div class="brand">
                    <div class="logo-icon">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <span class="brand-name">MiPortafolio</span>
                </div>
                <nav class="nav-menu">
                    <a href="inicio.php" class="nav-link">
                        <i class="fas fa-home"></i>
                        <span>Inicio</span>
                    </a>
                    <a href="perfil.php" class="nav-link active">
                        <i class="fas fa-user"></i>
                        <span>Perfil</span>
                    </a>
                    <a href="materias.php" class="nav-link">
                        <i class="fas fa-book"></i>
                        <span>Materias</span>
                    </a>
                    <a href="notas.php" class="nav-link">
                        <i class="fas fa-chart-bar"></i>
                        <span>Notas</span>
                    </a>
                    <a href="horario.php" class="nav-link">
                        <i class="fas fa-calendar"></i>
                        <span>Horario</span>
                    </a>
                    <a href="pensum.php" class="nav-link">
                        <i class="fas fa-graduation-cap"></i>
                        <span>Pensum de Estudio</span>
                    </a>
                    <a href="biblioteca.php" class="nav-link">
                        <i class="fas fa-book-reader"></i>
                        <span>Biblioteca</span>
                    </a>
                </nav>
            </div>
            <div class="sidebar-bottom">
                <div class="user-info">
                    <div class="user-avatar">
                        <i class="fas fa-user-circle"></i>
                    </div>
                    <div class="user-info">
                        <span class="user-name"><?php echo htmlspecialchars($_SESSION['nombres'] . ' ' . $_SESSION['apellidos']); ?></span>
                        <span class="user-role">Carnet: <?php echo htmlspecialchars($_SESSION['carnet']); ?></span>
                    </div>
                </div>
                <a href="../php/logout.php" class="logout-btn" style="display: flex; align-items: center; gap: 8px; margin-top: 1.5rem; padding: 8px 16px; border-radius: 6px; font-size: 0.95rem; color: #888; background: #f7f7f7; border: none; transition: background 0.2s, color 0.2s; text-decoration: none; box-shadow: none; opacity: 0.85;">
                    <i class="fas fa-sign-out-alt" style="font-size: 1.1em;"></i>
                    <span style="font-weight: 500;">Cerrar Sesión</span>
                </a>
            </div>
        </aside>
        <main class="main-content">
            <header class="content-header">
                <h1>Perfil del Estudiante</h1>
            </header>
            <div class="content-body">
                <div class="profile-card" style="background: #fff; border-radius: 1rem; box-shadow: 0 2px 10px rgba(0,0,0,0.05); padding: 2rem; max-width: 500px; margin: 2rem auto;">
                    <div style="text-align:center; margin-bottom: 1.5rem;">
                        <i class="fas fa-user-circle" style="font-size: 4rem; color: #2563eb;"></i>
                    </div>
                    <h2 style="text-align:center; margin-bottom: 1rem; color: #2563eb;">
                        <?php echo htmlspecialchars($_SESSION['nombres'] . ' ' . $_SESSION['apellidos']); ?>
                    </h2>
                    <p style="text-align:center; color: #64748b; margin-bottom: 1.5rem;">Carnet: <strong><?php echo htmlspecialchars($_SESSION['carnet']); ?></strong></p>
                    <hr style="margin: 1.5rem 0;">
                    <div style="color: #2d3748;">
                        <p><strong>Semestre actual:</strong> <span>No disponible</span></p>
                        <p><strong>Materias inscritas:</strong> <span>No disponible</span></p>
                        <p><strong>Correo:</strong> <span>No disponible</span></p>
                        <p><strong>Fecha de registro:</strong> <span>No disponible</span></p>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script src="../javascript/animaciones.js"></script>
</body>
</html>
