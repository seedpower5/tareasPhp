<?php
require_once 'Conexion/Conexion.php';
require_once 'Clases/Tareas.php';


$mensajeExito = '';
$mensajeError = '';

// Verificamos si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $nombre = $_POST['nombre'] ?? '';
    $descripcion = $_POST['descripcion'] ?? '';
    $fechaCreacion = $_POST['fechaCreacion'] ?? '';
    $completado = isset($_POST['completado']) ? 1 : 0;

    // Validar que los campos obligatorios no estén vacíos
    if (!empty($nombre) && !empty($descripcion) && !empty($fechaCreacion)) {
        // Crear una instancia de la clase Conexion
        $conexion = new Conexion();
        $conexionInstancia = $conexion->getConexion();

        // Añadir la nueva tarea utilizando el método añadirTarea
        $exito = Tareas::añadirTarea($conexionInstancia, $nombre, $descripcion, $fechaCreacion, $completado);

        if ($exito) {
            // Tarea añadida con éxito, redirigir a index.php
            header('Location: index.php');
            exit();
        } else {
            $mensajeError = 'Error al añadir la tarea. Por favor, inténtalo de nuevo.';
        }
    } else {
        $mensajeError = 'Todos los campos son obligatorios. Por favor, completa todos los campos.';
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Tarea</title>
    <!-- Vincula Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Vincula tu archivo CSS aquí -->
    <link rel="stylesheet" href="Css/index.css">
</head>
<body>

    <div class="container mt-5">
        <h2 class="mb-4">Agregar Nueva Tarea</h2>

        <!-- Mostrar mensajes de éxito o error -->
        <?php if (!empty($mensajeExito)): ?>
            <div class="alert alert-success" role="alert">
                <?php echo $mensajeExito; ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($mensajeError)): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $mensajeError; ?>
            </div>
        <?php endif; ?>

        <!-- Formulario para agregar nueva tarea -->
        <form method="post" action="">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción:</label>
                <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label for="fechaCreacion" class="form-label">Fecha de Creación:</label>
                <input type="date" class="form-control" id="fechaCreacion" name="fechaCreacion" required>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="completado" name="completado">
                <label class="form-check-label" for="completado">Completado</label>
            </div>
            <button type="submit" class="btn btn-primary">Agregar Tarea</button>
        </form>
    </div>

    <!-- Vincula Bootstrap JS y Popper.js (requerido para algunos componentes de Bootstrap) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
