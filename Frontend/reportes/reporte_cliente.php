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

$usuario = $_SESSION['usuario'];
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
                                <a class="active" href="./reporte_cliente.php">Clientes</a>
                            </li>
                        </ul>
                        <ul class="breadcrumb">
                            <li>
                                <a class="active" href="../cliente/formulario_cliente.php">Registrar</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            <div class="table-data">
                <div class="container">
                    <div class="titulo" align="center">
                        <h2>Listado de Clientes</h2>
                    </div>
                    <div class"row">
                        <div class="col-lg-12">
                            <table id="tablaUsuarios" class="table-striped table-bordered" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Cedula</th>
                                        <th>Nombre</th>
                                        <th>RUC</th>
                                        <th>Departamento</th>
                                        <th>Ciudad</th>
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
                                    columns: [0, 1, 2, 3, 4, 5]
                                }
                            },
                            {
                                extend: 'pdfHtml5',
                                text: 'PDF',
                                titleAttr: 'Exportar a PDF',
                                className: 'btn btn-danger',
                                exportOptions: {
                                    columns: [0, 1, 2, 3, 4, 5]
                                }
                            },
                            {
                                extend: 'print',
                                text: 'Imprimir',
                                titleAttr: 'Imprimir',
                                className: 'btn btn-info',
                                exportOptions: {
                                    columns: [0, 1, 2, 3, 4, 5]
                                }
                            },
                        ],
                        "ajax": {
                            "url": "list_cliente.php",
                            "dataSrc": ""
                        },
                        "columns": [{
                                "data": "id_cliente"
                            },
                            {
                                "data": "cedula"
                            },
                            {
                                "data": "nombre"
                            },
                            {
                                "data": "ruc"
                            },
                            {
                                "data": "nombre_depar"
                            },
                            {
                                "data": "nombre_ciudad"
                            },
                            {
                                "data": null,
                                "render": function(data, type, row) {
                                    return '<a href="../cliente/editar_cliente.php?id_cliente=' + row.id_cliente + '" class="submitBoton">Editar</a>';
                                }
                            },
                            {
                                "data": null,
                                "render": function(data, type, row) {
                                    return '<a href="../../Backend/cliente/eliminar_cliente.php?id_cliente=' + row.id_cliente + '" class="submitBotonEliminar">Borrar</a>';
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