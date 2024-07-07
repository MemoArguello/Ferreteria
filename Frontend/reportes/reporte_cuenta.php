<?php require "../../include/header.php" ?>
<?php require "../../backend/config/baseDeDatos.php"?>
<?php

$usuario = $_SESSION['usuario'];
if (!isset($usuario)) {
    header("location:../../index.php");
}

$conexiondb = conectardb();
$sql = "SELECT id_cargo FROM `usuarios` WHERE usuario = '$usuario';";
$result = mysqli_query($conexiondb, $sql);



$conexiondb = conectardb();
$query = "SELECT * FROM cargo ORDER BY id ASC";
$resultado = mysqli_query($conexiondb, $query);


mysqli_close($conexiondb);
?>
    <section id="content">
        <main>
                <div class="left">
                    <nav class="nav">
                    <ul class="breadcrumb">
                        <li>
                            <a class="active" href="./reporte_cuenta.php">Cuentas</a>
                        </li>
                    </ul>
                    <ul class="breadcrumb">
                        <li>
                            <a class="active" href="../configuracion/registrar_usuario.php">Registrar Cuenta</a>
                        </li>
                    </ul>
                    </nav>
                </div>
            <div class="table-data">
                <div class="container">
                    <div class="titulo" align="center">
                        <h2>Cuentas Existentes</h2>
                    </div>
                    <div class"row">
                        <div class="col-lg-12">
                            <table id="tablaUsuarios" class="table-striped table-bordered" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Correo</th>
                                        <th>Usuario</th>
                                        <th>Cargo</th>
                                        <th>Contraseña</th>
                                        <th>Editar</th>
                                        <th>Eliminar</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!--Jquery. popper.js, Bootstrap JS-->
            <script src="jquery/jquery-3.5.1.min.js"></script>
            <script src="popper/popper.min.js"></script>
            <script src="bootstrap/js/bootstrap.min.js"></script>
            <!--Datatables JS-->
            <script type="text/javascript" src="datatables/datatables.min.js"></script>
            <!--Para usar botones en datatables JS-->
            <script src="datatables/Buttons-2.3.2/js/dataTables.buttons.js"></script>
            <script src="datatables/JSZip-2.5.0/jszip.min.js"></script>
            <script src="datatables/pdfmake-0.1.36/pdfmake.js"></script>
            <script src="datatables/pdfmake-0.1.36/vfs_fonts.js"></script>
            <script src="datatables/Buttons-2.3.2/js/buttons.html5.min.js"></script>
            <script>
                $(document).ready(function() {
                    $('#tablaUsuarios').DataTable({
                        responsive: "true",
                        dom: 'Bfrtilp',
                        buttons: [{
                                extend: 'excelHtml5',
                                text: 'Excel',
                                titleAttr: 'Exportar a Excel',
                                className: 'btn btn-success',
                                exportOptions: {
                                    columns: [0, 1, 2, 3] // Incluir solo las primeras 4 columnas
                                }
                            },
                            {
                                extend: 'pdfHtml5',
                                text: 'PDF',
                                titleAttr: 'Exportar a PDF',
                                className: 'btn btn-danger',
                                exportOptions: {
                                    columns: [0, 1, 2, 3] // Incluir solo las primeras 4 columnas
                                }
                            },
                            {
                                extend: 'print',
                                text: 'Imprimir',
                                titleAttr: 'Imprimir',
                                className: 'btn btn-info',
                                exportOptions: {
                                    columns: [0, 1, 2, 3] // Incluir solo las primeras 4 columnas
                                }
                            },
                        ],
                        "ajax": {
                            "url": "list_cuenta.php",
                            "dataSrc": ""
                        },
                        "columns": [{
                                "data": "id_usuario"
                            },
                            {
                                "data": "correo"
                            },
                            {
                                "data": "usuario"
                            },
                            {
                                "data": "descripcion"
                            },
                            {
                                "data": null,
                                "render": function(data, type, row) {
                                    return '<a href="../configuracion/editar_contraseña.php?id_usuario=' + row.id_usuario + '" class="submitBotonPass">Cambiar</a>';
                                }
                            },
                            {
                                "data": null,
                                "render": function(data, type, row) {
                                    return '<a href="../configuracion/editar_cuenta.php?id_usuario=' + row.id_usuario + '" class="submitBoton">Editar</a>';
                                }
                            },
                            {
                                "data": null,
                                "render": function(data, type, row) {
                                    return '<a href="../../Backend/cuenta/eliminar_cuenta.php?id_usuario=' + row.id_usuario + '" class="submitBotonEliminar">Borrar</a>';
                                }
                            }
                        ]
                    });
                });
            </script>
            </div>
        </main>
    </section>
    <script src="../dashboard/script.js"></script>

</body>

</html>