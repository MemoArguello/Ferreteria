
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="<?=APPURL?>/Frontend/dashboard/script.js"></script>
<script src="<?=APPURL?>/Frontend/js/script.js"></script>
<script src="<?=APPURL?>/Frontend/datatable/datatables.js"></script>
<script src="<?=APPURL?>/Frontend/datatable/datatables.min.js"></script>

<script>
        $(document).ready(function() {
            new DataTable('#listado', {
                responsive: true,
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json',
                    paginate: {
                        first: '<<',
                        previous: 'Ant',
                        next: 'Sig',
                        last: '>>'
                    }
                }
            });
        });
</script>
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
            cancelButtonText: 'Cancelar',
            customClass: {
                title: 'my-title-class',
                text: 'my-text-class',
                confirmButton: 'my-confirm-button-class',
                cancelButton: 'my-cancel-button-class'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '../../Backend/validacion/cerrar_sesion.php';
            }
        });
    }

    function confirmarEliminarFactura(id_factura) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: 'Se eliminará esta factura permanentemente.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar',
            customClass: {
                title: 'my-title-class',
                text: 'my-text-class',
                confirmButton: 'my-confirm-button-class',
                cancelButton: 'my-cancel-button-class'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('formEliminarFactura' + id_factura).submit();
            }
        });
    }

    function confirmarEliminarCat(id_categoria) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: 'Se eliminará esta categoria permanentemente.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar',
            customClass: {
                title: 'my-title-class',
                text: 'my-text-class',
                confirmButton: 'my-confirm-button-class',
                cancelButton: 'my-cancel-button-class'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('formEliminarCat' + id_categoria).submit();
            }
        });
    }
    function confirmarEliminarProd(id_producto) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: 'Se eliminará esta Producto permanentemente.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar',
            customClass: {
                title: 'my-title-class',
                text: 'my-text-class',
                confirmButton: 'my-confirm-button-class',
                cancelButton: 'my-cancel-button-class'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('formEliminarProd' + id_producto).submit();
            }
        });
    }

    function confirmarEliminarProv(id_proveedor) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: 'Se eliminará este proveedor permanentemente.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar',
            customClass: {
                title: 'my-title-class',
                text: 'my-text-class',
                confirmButton: 'my-confirm-button-class',
                cancelButton: 'my-cancel-button-class'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('formEliminarProv' + id_proveedor).submit();
            }
        });
    }
    function confirmarEliminarUsuario(id_usuario) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: 'Se eliminará este Usuario permanentemente.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar',
            customClass: {
                title: 'my-title-class',
                text: 'my-text-class',
                confirmButton: 'my-confirm-button-class',
                cancelButton: 'my-cancel-button-class'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('formEliminarUsuario_' + id_usuario).submit();
            }
        });
    }

    function confirmarEliminarCliente(clienteId) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: 'Se eliminará este Cliente permanentemente.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar',
            customClass: {
                title: 'my-title-class',
                text: 'my-text-class',
                confirmButton: 'my-confirm-button-class',
                cancelButton: 'my-cancel-button-class'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('formEliminarCliente_' + clienteId).submit();
            }
        });
    }

</script>


    </body>
</html>