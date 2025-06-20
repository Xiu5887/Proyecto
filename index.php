<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido | MiPortafolioDigital - UNEFA</title>
    <link rel="stylesheet" href="asset/css/lobby.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body::before {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('asset/images/fondo-lobby-atractivo.jpg') no-repeat center center/cover;
            opacity: 0.08;
            z-index: -1;
        }

        .hero-image {
            position: relative;
        }
    </style>
</head>

<body>
    <?php session_start(); ?>
    
    <nav class="navbar">
        <div class="nav-brand">
            <img src="asset/images/escudounefa.jpg" alt="UNEFA" class="logo">
            <div class="brand-text">
                <span class="brand-title">UNEFA</span>
                <span class="brand-subtitle">Sede Carúpano</span>
            </div>
        </div>
        <div class="nav-links">
            <a href="#" class="nav-link"><i class="fas fa-info-circle"></i> Acerca de</a>
            <a href="#" class="nav-link"><i class="fas fa-envelope"></i> Contacto</a>
        </div>
    </nav>

    <main class="hero">
        <div class="hero-content">
            <div class="hero-text">
                <h1 class="hero-title">
                    <span class="welcome-text">Bienvenido a</span>
                    <span class="brand-name">MiPortafolioDigital</span>
                </h1>
                <p class="hero-description">Tu plataforma académica integral en UNEFA. Gestiona tus estudios de manera eficiente y moderna.</p>
                
                <div class="features">
                    <div class="feature-item">
                        <i class="fas fa-graduation-cap"></i>
                        <span>Gestión Académica</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-calendar-alt"></i>
                        <span>Horarios</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-chart-line"></i>
                        <span>Calificaciones</span>
                    </div>
                </div>

                <?php if (!isset($_SESSION['id'])): ?>
                <div class="cta-buttons">
                    <a href="src/vistas/registro.php" class="btn btn-primary">
                        <i class="fas fa-user-plus"></i> Crear cuenta
                    </a>
                    <a href="src/vistas/login.php" class="btn btn-secondary">
                        <i class="fas fa-sign-in-alt"></i> Iniciar sesión
                    </a>
                </div>
                <?php else: ?>
                <div class="cta-buttons" style="display:flex; flex-direction:column; align-items:center; gap: 10px;">
                    <div style="background:#fffbe6; border:1px solid #ffe58f; color:#ad8b00; padding:15px; border-radius:8px; margin-bottom:10px; text-align:center; max-width:350px;">
                        <strong>¡Ya tienes una sesión activa!</strong><br>
                        Puedes continuar tu sesión o cerrarla si no eres tú.
                    </div>
                    <a href="src/vistas/verificar.php" class="btn btn-primary" style="width:220px;">
                        <i class="fas fa-shield-alt"></i> Continuar sesión
                    </a>
                    <a href="src/controlador/logout.php" class="btn btn-secondary" style="width:220px;">
                        <i class="fas fa-sign-out-alt"></i> Cerrar sesión activa
                    </a>
                </div>
                <?php endif; ?>
            </div>

            <div class="hero-image">
                <img src="asset/images/etudiante.png" alt="Estudiante UNEFA" class="main-illustration">
            </div>
        </div>

        <?php if (isset($_SESSION['usuario'])): ?>
        <div class="user-welcome">
            <i class="fas fa-user-circle"></i>
            <p>Bienvenido de nuevo, <strong><?php echo htmlspecialchars($_SESSION['usuario']); ?></strong></p>
        
        </div>
        <?php endif; ?>
    </main>

    <div class="wave-decoration">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path fill="#0033a0" fill-opacity="0.1" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,112C672,96,768,96,864,112C960,128,1056,160,1152,160C1248,160,1344,128,1392,112L1440,96L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
        </svg>
    </div>
</body>
</html>
