<script>
    function confirmarCerrarSesion() {
        Swal.fire({
            title: '¿Estás seguro?',
            text: "Se cerrará la sesión actual.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, cerrar sesión',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '../../Backend/validacion/cerrar_sesion.php';
            }
        });
    }
</script>
