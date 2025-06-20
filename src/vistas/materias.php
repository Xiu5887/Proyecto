<?php
require_once __DIR__ . '/../../conexion.php';
session_start();

if (!isset($_SESSION['id'])) {
    header('Location: ../../index.php');
    exit();
}

$student_id = $_SESSION['id'];
$success_message = '';

// Procesar el formulario cuando se envía
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener las materias seleccionadas del formulario
    $selected_materias = $_POST['materias'] ?? [];

    // Borrar las inscripciones anteriores del estudiante
    $sql_delete = "DELETE FROM inscripciones WHERE estudiante_id = ?";
    $stmt_delete = $conn->prepare($sql_delete);
    $stmt_delete->execute([$student_id]);

    // Insertar las nuevas inscripciones
    if (!empty($selected_materias)) {
        $sql_insert = "INSERT INTO inscripciones (estudiante_id, materia_id) VALUES (?, ?)";
        $stmt_insert = $conn->prepare($sql_insert);
        foreach ($selected_materias as $materia_id) {
            $stmt_insert->execute([$student_id, $materia_id]);
        }
    }
    $success_message = '¡Tus materias han sido actualizadas con éxito!';
}

// Obtener todas las materias del pensum, ordenadas por semestre
$sql_materias = "SELECT semestre, id, nombre, contenido_url FROM materias ORDER BY semestre, nombre";
$stmt_materias = $conn->query($sql_materias);
$all_materias = $stmt_materias->fetchAll(PDO::FETCH_GROUP | PDO::FETCH_ASSOC);

// Obtener las materias en las que el estudiante ya está inscrito
$sql_inscripciones = "SELECT materia_id FROM inscripciones WHERE estudiante_id = ?";
$stmt_inscripciones = $conn->prepare($sql_inscripciones);
$stmt_inscripciones->execute([$student_id]);
$inscripciones_activas = $stmt_inscripciones->fetchAll(PDO::FETCH_COLUMN);

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Materias | MiPortafolioDigital</title>
    <link rel="stylesheet" href="/1/asset/css/estilo.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .materias-form .card {
            margin-bottom: 20px;
        }
        .materias-form h3 {
            border-bottom: 2px solid #f0f0f0;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }
        .materia-item {
            display: flex;
            align-items: center;
            justify-content: space-between; /* Alinea el contenido */
            margin-bottom: 10px;
        }
        .materia-info {
            display: flex;
            align-items: center;
        }
        .download-link {
            color: #4a6cf7;
            text-decoration: none;
            font-size: 1.1rem;
            transition: color 0.3s;
        }
        .download-link:hover {
            color: #3557e0;
        }
        .materia-item input[type='checkbox'] {
            margin-right: 15px;
            width: 18px;
            height: 18px;
        }
        .submit-materias-btn {
            background-color: #4a6cf7;
            color: white;
            padding: 15px 30px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            transition: background-color 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }
        .submit-materias-btn:hover {
            background-color: #3557e0;
        }
        .success-banner {
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 8px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="app-container">
        <aside class="sidebar">
            <div class="sidebar-top">
                <div class="brand">
                    <div class="logo-icon"><i class="fas fa-graduation-cap"></i></div>
                    <span class="brand-name">MiPortafolio</span>
                </div>
                <nav class="nav-menu">
                    <a href="Inicio.php" class="nav-link"><i class="fas fa-home"></i><span>Inicio</span></a>
                    <a href="perfil.php" class="nav-link"><i class="fas fa-user"></i><span>Perfil</span></a>
                    <a href="materias.php" class="nav-link active"><i class="fas fa-book"></i><span>Materias</span></a>
                    <a href="notas.php" class="nav-link"><i class="fas fa-clipboard-check"></i><span>Notas</span></a>
                    <a href="horario.php" class="nav-link"><i class="fas fa-calendar-alt"></i><span>Horario</span></a>
                    <a href="pensum.php" class="nav-link"><i class="fas fa-file-alt"></i><span>Pensum</span></a>
                    <a href="biblioteca.php" class="nav-link"><i class="fas fa-book-open"></i><span>Biblioteca</span></a>
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
        <main class="main-content">
            <header class="main-header">
                <h1>Gestión de Materias</h1>
                <p>Selecciona las materias que estás cursando para activarlas en tu portafolio.</p>
            </header>
            <section class="content-body">
                <?php if ($success_message): ?>
                    <div class="success-banner">
                        <p><?php echo htmlspecialchars($success_message); ?></p>
                    </div>
                <?php endif; ?>

                <form action="materias.php" method="POST" class="materias-form">
                    <?php foreach ($all_materias as $semestre => $materias_list): ?>
                        <div class="card">
                            <h3>Semestre <?php echo $semestre; ?></h3>
                            <?php foreach ($materias_list as $materia): ?>
                                <?php if (isset($materia['id'], $materia['nombre'])): ?>
                                <div class="materia-item">
                                    <div class="materia-info">
                                        <input 
                                            type="checkbox" 
                                            name="materias[]" 
                                            value="<?php echo $materia['id']; ?>" 
                                            id="materia-<?php echo $materia['id']; ?>"
                                            <?php echo in_array($materia['id'], $inscripciones_activas) ? 'checked' : ''; ?>
                                        >
                                        <label for="materia-<?php echo $materia['id']; ?>">
                                            <?php echo htmlspecialchars($materia['nombre']); ?>
                                        </label>
                                    </div>
                                    <?php if (!empty($materia['contenido_url'])) : ?>
                                        <a href="../controlador/descargar.php?materia_id=<?php echo $materia['id']; ?>" class="download-link" title="Descargar contenido programático">
                                            <i class="fas fa-download"></i>
                                        </a>
                                    <?php endif; ?>
                                </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    <?php endforeach; ?>
                    <button type="submit" class="submit-materias-btn">
                        <i class="fas fa-save"></i>
                        Guardar Mis Materias
                    </button>
                </form>
            </section>
        </main>
    </div>
    <script src="../javascript/animaciones.js"></script>
</body>
</html>
