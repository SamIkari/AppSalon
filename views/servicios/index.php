<h1 class="nombre-pagina">Servicios</h1>
<p class="descripcion-pagina">Administración de Servicios</p>

<?php
    include_once __DIR__ . '/../Templates/barra.php';
?>

<ul class="servicios">
    <?php foreach($servicios as $servicio) { ?>
        <li id="servicio-<?php echo $servicio->id; ?>">
            <p>Nombre: <span><?php echo $servicio->nombre; ?></span> </p>
            <p>Precio: <span>$<?php echo $servicio->precio; ?></span> </p>

            <div class="acciones">
                <a class="boton" href="/servicios/actualizar?id=<?php echo $servicio->id; ?>">Actualizar</a>

                <!-- Botón modificado para activar/desactivar con una función JS -->
                <button 
                    id="boton-estado-<?php echo $servicio->id; ?>"
                    class="boton-eliminar" 
                    onclick="cambiarEstadoServicio(<?php echo $servicio->id; ?>, <?php echo $servicio->estado === '1' ? '0' : '1'; ?>)"
                >
                    <?php echo $servicio->estado === '1' ? 'Desactivar' : 'Activar'; ?>
                </button>
            </div>
        </li>
    <?php } ?>
</ul>

<script src='//cdn.jsdelivr.net/npm/sweetalert2@11'></script>

<script>
// Función para cambiar el estado de un servicio con SweetAlert2
function cambiarEstadoServicio(id, estado) {
    const accion = estado === 1 ? 'activar' : 'desactivar';
    
    // Mostrar la alerta de confirmación
    Swal.fire({
        title: `¿Estás seguro de que quieres ${accion} el servicio?`,
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: `Sí, ${accion}lo`,
        cancelButtonText: 'No, cancelar',
        reverseButtons: true,
    }).then((result) => {
        if (result.isConfirmed) {
            // Si el usuario confirma, enviamos la solicitud con fetch
            const formData = new FormData();
            formData.append('id', id);
            formData.append('estado', estado);

            fetch('/api/cambiarEstado', {
                method: 'POST',
                body: formData,
            })
            .then(response => response.json())
            .then(data => {
                // Cambiar el estado visual del servicio dependiendo del resultado
                const servicioElement = document.getElementById('servicio-' + id);
                const botonEstado = document.getElementById('boton-estado-' + id);

                // Actualizar el estado visual
                if (data.estado == 1) {
                    servicioElement.classList.remove('desactivado');
                    servicioElement.classList.add('activo');
                    botonEstado.textContent = 'Desactivar'; // Cambiar el texto a "Desactivar"
                } else {
                    servicioElement.classList.remove('activo');
                    servicioElement.classList.add('desactivado');
                    botonEstado.textContent = 'Activar'; // Cambiar el texto a "Activar"
                }

                // Mostrar una alerta de éxito
                Swal.fire({
                    icon: 'success',
                    title: `${accion.charAt(0).toUpperCase() + accion.slice(1)} exitoso`,
                    text: `El servicio ha sido ${accion}do correctamente.`,
                });
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Hubo un error al cambiar el estado del servicio.',
                });
            });
        } else {
            // Si el usuario cancela la acción
            Swal.fire({
                icon: 'info',
                title: 'Acción cancelada',
                text: 'El servicio no ha sido modificado.',
            });
        }
    });
}
</script>
