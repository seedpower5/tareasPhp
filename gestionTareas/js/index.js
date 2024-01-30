// Codigo js del Domm para efectuar codigo despues de la carga del html completo y efectuar el manejador on click de evento
document.addEventListener('DOMContentLoaded', function () {
    const botonesBorrar = document.querySelectorAll('.btn-borrar');

    botonesBorrar.forEach(boton => {
        boton.addEventListener('click', function () {
            // Confirmar antes de borrar
            if (confirm('¿Estás seguro de que quieres borrar esta tarea?')) {
                // Obtener el ID de la tarea desde el atributo data-id
                const idTarea = this.getAttribute('data-id');

                // Realizar la solicitud AJAX o llamar al backend para borrar la tarea
                // En este ejemplo, se utiliza una URL ficticia '/borrar_tarea.php'
                fetch('/index.php?id=' + idTarea)
                    .then(response => response.json())
                    .then(data => {
                        // Recargar la página o actualizar la lista de tareas después de borrar
                        location.reload();
                    })
                    .catch(error => {
                        console.error('Error al borrar tarea:', error);
                    });
            }
        });
    });
});
