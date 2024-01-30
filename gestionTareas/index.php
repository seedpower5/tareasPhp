<?php
require_once 'Conexion/Conexion.php';
require_once 'Clases/Tareas.php';

// Crear una instancia de la clase Conexion
$conexion = new Conexion();

// Obtener la conexión de la instancia de la clase Conexion
$conexionInstancia = $conexion->getConexion();

// Visualizar todas las tareas usando el método visualizarTareas
$tareas = Tareas::visualizarTareas($conexionInstancia);

// Manejar el borrado si se ha enviado un ID
if (isset($_GET['borrar']) && is_numeric($_GET['borrar'])) {
    $idTareaBorrar = $_GET['borrar'];

    // Realizar la lógica para borrar la tarea en la base de datos (ejemplo)
    $exitoBorrado = Tareas::borrarTarea($conexionInstancia, $idTareaBorrar);

    if ($exitoBorrado) {
        // Redireccionar a la misma página después de borrar
        header('Location: index.php');
        exit();
    } else {
        echo "Error al intentar borrar la tarea.";
    }
}
// Verificar si se ha enviado el parámetro completar
if (isset($_GET['completar']) && is_numeric($_GET['completar'])) {
    $idTareaCompletar = $_GET['completar'];
    // Completar la tarea utilizando el método completarTarea
    $exitoCompletar = Tareas::completarTarea($conexionInstancia, $idTareaCompletar);

    if ($exitoCompletar) {
        // Tarea completada con éxito, redirigir a index.php
        header('Location: index.php');
        exit();
    } else {
        echo "Error al intentar completar la tarea.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Tareas</title>
    <!-- Vinculacion Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Vinculacion tu archivo CSS aquí -->
    <link rel="stylesheet" href="Css/index.css">
    <!-- Vinculacion del archivo js -->
    <script src="js/index.js"></script>
</head>

<body>

    <div class="container mt-5">
        <h2 class="mb-4">Lista de Tareas</h2>

        <?php if (count($tareas) > 0) : ?>
            <table class="table">
                <a class="btn btn-success" href="agregarTarea.php">Añadir Tarea</a>
                <thead>
                    <tr>

                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Fecha de Creación</th>
                        <th>Fecha de Finalización</th>
                        <th>Completado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tareas as $tarea) : ?>
                        <tr>
                            <td><?php echo $tarea->getId(); ?></td>
                            <td><?php echo $tarea->getNombre(); ?></td>
                            <td><?php echo $tarea->getDescripcion(); ?></td>
                            <td><?php echo $tarea->getFechaCreacion(); ?></td>
                            <td><?php echo $tarea->getCompletado() ? 'Sí' : 'No'; ?></td>
                            <td>
                                <!-- aqui hago que se activen o desactiven los botones de completar y borrar según si la tarea esta o no completada -->
                                <?php if (!$tarea->getCompletado()) : ?>
                                    <!-- Botón Completar con enlace a la misma página con el ID de la tarea -->
                                    <a class="btn btn-warning" href="?completar=<?php echo $tarea->getId(); ?>">Completar</a>
                                <?php endif; ?>
                                <?php if ($tarea->getCompletado()) : ?>
                                    <!-- Botón Borrar con enlace a la misma página con el ID de la tarea -->
                                    <a class="btn btn-danger" href="?borrar=<?php echo $tarea->getId(); ?>">Borrar</a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else : ?>
            <p>No hay tareas disponibles.</p>
        <?php endif; ?>
    </div>

    <!-- Vincula Bootstrap JS y Popper.js (requerido para algunos componentes de Bootstrap) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>