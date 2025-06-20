<?php
require_once __DIR__ . '/../../conexion.php';
session_start();
if (!isset($_SESSION['id'])) {
    header('Location: login.php');
    exit();
}

// Contar las materias activas del estudiante
$student_id = $_SESSION['id'];
$sql_count = "SELECT COUNT(*) FROM inscripciones WHERE estudiante_id = ?";
$stmt_count = $conn->prepare($sql_count);
$stmt_count->execute([$student_id]);
$materias_activas_count = $stmt_count->fetchColumn();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MiPortafolioDigital | Panel</title>
    <link rel="stylesheet" href="../../asset/css/estilo.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="app-container">
        <!-- Sidebar minimalista -->
        <aside class="sidebar">
            <div class="sidebar-top">
                <div class="brand">
                    <div class="logo-icon">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <span class="brand-name">MiPortafolio</span>
                </div>

                <nav class="nav-menu">
                    <a href="inicio.php" class="nav-link active">
                        <i class="fas fa-home"></i>
                        <span>Inicio</span>
                    </a>
                    <a href="perfil.php" class="nav-link">
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
                <a href="../controlador/logout.php" class="logout-btn">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Cerrar Sesión</span>
                </a>
            </div>
        </aside>

        <!-- Contenido principal -->
        <main class="main-content">
            <header class="content-header">
                <div class="header-left">
                    <button class="menu-toggle">
                        <i class="fas fa-bars"></i>
                    </button>
                    <h1>Panel Principal</h1>
                </div>
                <div class="header-right">
                    <div class="search-bar">
                        <i class="fas fa-search"></i>
                        <input type="text" placeholder="Buscar...">
                    </div>
                    <button class="notification-btn">
                        <i class="fas fa-bell"></i>
                        <span class="notification-badge">3</span>
                    </button>
                </div>
            </header>

            <div class="content-body">
                <!-- Tarjetas de resumen -->
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-book-open"></i>
                        </div>
                        <div class="stat-info">
                            <h3>Materias Activas</h3>
                            <p class="stat-number"><?php echo $materias_activas_count; ?></p>
                            <span class="stat-trend positive">
                                <i class="fas fa-arrow-up"></i> 2 más que el semestre anterior
                            </span>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <div class="stat-info">
                            <h3>Promedio General</h3>
                            <p class="stat-number">18.5</p>
                            <span class="stat-trend positive">
                                <i class="fas fa-arrow-up"></i> +0.5 pts
                            </span>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-tasks"></i>
                        </div>
                        <div class="stat-info">
                            <h3>Tareas Pendientes</h3>
                            <p class="stat-number">4</p>
                            <span class="stat-trend neutral">
                                Sin cambios esta semana
                            </span>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="stat-info">
                            <h3>Horas de Estudio</h3>
                            <p class="stat-number">24h</p>
                            <span class="stat-trend positive">
                                <i class="fas fa-arrow-up"></i> +2h esta semana
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Sección de actividad reciente -->
                <section class="recent-activity">
                    <div class="section-header">
                        <h2>Actividad Reciente</h2>
                        <button class="view-all-btn">Ver todo</button>
                    </div>
                    <div class="activity-list">
                        <div class="activity-item">
                            <div class="activity-icon">
                                <i class="fas fa-file-alt"></i>
                            </div>
                            <div class="activity-details">
                                <h4>Entrega de Proyecto</h4>
                                <p>Matemáticas Discretas - Proyecto Final</p>
                                <span class="activity-time">Hace 2 horas</span>
                            </div>
                            <div class="activity-status completed">
                                <i class="fas fa-check"></i>
                            </div>
                        </div>

                        <div class="activity-item">
                            <div class="activity-icon">
                                <i class="fas fa-edit"></i>
                            </div>
                            <div class="activity-details">
                                <h4>Examen Parcial</h4>
                                <p>Programación II - Segundo Parcial</p>
                                <span class="activity-time">Ayer</span>
                            </div>
                            <div class="activity-status pending">
                                <i class="fas fa-clock"></i>
                            </div>
                        </div>

                        <div class="activity-item">
                            <div class="activity-icon">
                                <i class="fas fa-book"></i>
                            </div>
                            <div class="activity-details">
                                <h4>Material de Estudio</h4>
                                <p>Física I - Nuevo contenido disponible</p>
                                <span class="activity-time">Hace 2 días</span>
                            </div>
                            <div class="activity-status new">
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Sección de próximos eventos -->
                <section class="upcoming-events">
                    <div class="section-header">
                        <h2>Próximos Eventos</h2>
                        <button class="calendar-btn">
                            <i class="fas fa-calendar-alt"></i>
                            Calendario
                        </button>
                    </div>
                    <div class="events-timeline">
                        <div class="event-card">
                            <div class="event-date">
                                <span class="day">15</span>
                                <span class="month">MAY</span>
                            </div>
                            <div class="event-info">
                                <h4>Presentación de Proyecto</h4>
                                <p>Ingeniería de Software</p>
                                <span class="event-time">
                                    <i class="fas fa-clock"></i> 10:00 AM
                                </span>
                            </div>
                        </div>

                        <div class="event-card">
                            <div class="event-date">
                                <span class="day">18</span>
                                <span class="month">MAY</span>
                            </div>
                            <div class="event-info">
                                <h4>Examen Final</h4>
                                <p>Cálculo III</p>
                                <span class="event-time">
                                    <i class="fas fa-clock"></i> 2:30 PM
                                </span>
                            </div>
                        </div>

                        <div class="event-card">
                            <div class="event-date">
                                <span class="day">20</span>
                                <span class="month">MAY</span>
                            </div>
                            <div class="event-info">
                                <h4>Taller Práctico</h4>
                                <p>Redes de Computadoras</p>
                                <span class="event-time">
                                    <i class="fas fa-clock"></i> 9:00 AM
                                </span>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </main>
    </div>

    <script>
        // Toggle del menú en dispositivos móviles
        document.querySelector('.menu-toggle').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('active');
        });

        // Activar/desactivar enlaces de navegación
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', function(e) {
                document.querySelectorAll('.nav-link').forEach(l => l.classList.remove('active'));
                this.classList.add('active');
            });
        });
    </script>
</body>
</html>
