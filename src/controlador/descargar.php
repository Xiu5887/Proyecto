<?php
require_once __DIR__ . '/../../conexion.php';
session_start();

// 1. Verificar que el usuario tiene una sesión activa
if (!isset($_SESSION['id'])) {
    die('Acceso denegado. Debes iniciar sesión.');
}

// 2. Verificar que se ha proporcionado un ID de materia
if (!isset($_GET['materia_id']) || !is_numeric($_GET['materia_id'])) {
    die('Solicitud inválida. No se especificó la materia.');
}

$student_id = $_SESSION['id'];
$materia_id = $_GET['materia_id'];

// La verificación de inscripción se ha eliminado para permitir la descarga desde el pensum.

// 4. Obtener la ruta del archivo desde la base de datos
$sql_get_file = "SELECT contenido_url, nombre FROM materias WHERE id = ?";
$stmt_get_file = $conn->prepare($sql_get_file);
$stmt_get_file->execute([$materia_id]);
$materia = $stmt_get_file->fetch(PDO::FETCH_ASSOC);

if (!$materia || empty($materia['contenido_url'])) {
    die('Esta materia no tiene contenido programático disponible para descargar.');
}

// 5. Construir la ruta completa y segura al archivo
$filename = $materia['contenido_url'];
$filepath = __DIR__ . '/../../storage/' . $filename;

// 6. Verificar que el archivo existe en el servidor
if (!file_exists($filepath)) {
    die('Error: El archivo no se pudo encontrar en el servidor.');
}

// 7. Enviar los encabezados para forzar la descarga
header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream'); // Tipo genérico para forzar descarga
header('Content-Disposition: attachment; filename="' . basename($filepath) . '"');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($filepath));

// Limpiar el buffer de salida antes de leer el archivo
ob_clean();
flush();

// 8. Leer el archivo y enviarlo al navegador
readfile($filepath);
exit;
?>
