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
$usuario = $_SESSION['usuario'];
$queryUsuario = "SELECT id_usuario FROM usuarios WHERE usuario = '$usuario'";
$resultadoUsuario = mysqli_query($conexiondb, $queryUsuario);

// Verificar si se obtuvo el resultado
if ($resultadoUsuario) {
    // Obtener el ID del usuario
    $usuarioInfo = mysqli_fetch_assoc($resultadoUsuario);
    $idUsuario = $usuarioInfo['id_usuario'];
} else {
    // Manejar el error si la consulta no fue exitosa
    echo "Error al obtener el ID del usuario.";
    exit();
}
mysqli_close($conexiondb);

?>
    <section id="content">
        <main>
            <div class="left">
                <nav class="nav">
                    <ul class="breadcrumb">
                        <li>
                            <a class="active" href="./reporte_caja.php">Cajas</a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="table-data">
                <div class="container">
                    <div class="titulo" align="center">
                        <h2>Cajas</h2>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <table id="tablaUsuarios" class="table-striped table-bordered" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Fecha Apertura</th>
                                        <th>Fecha Cierre</th>
                                        <th>Ingreso</th>
                                        <th>Egreso</th>
                                        <th>Saldo_cierre</th>
                                        <th>Estado</th>
                                        <th>Cerrar Caja</th>
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
                                    columns: [0, 1, 2, 3, 4, 5, 6]
                                }
                            },
                            {
                                extend: 'pdfHtml5',
                                text: 'PDF',
                                titleAttr: 'Exportar a PDF',
                                className: 'btn btn-danger',
                                exportOptions: {
                                    columns: [0, 1, 2, 3, 4, 5, 6]
                                }
                            },
                            {
                                extend: 'print',
                                text: 'Imprimir',
                                titleAttr: 'Imprimir',
                                className: 'btn btn-info',
                                exportOptions: {
                                    columns: [0, 1, 2, 3, 4, 5, 6]
                                }
                            },
                            {
                                text: 'Abrir Caja',
                                className: 'btn btn-success',
                                action: function() {
                                    window.location.href = '../../Backend/caja/abrir.php?id_usuario=<?php echo $idUsuario; ?>';
                                }

                            },
                        ],
                        "ajax": {
                            "url": "list_caja.php",
                            "dataSrc": ""
                        },
                        "columns": [{
                                "data": "id_caja"
                            },
                            {
                                "data": "fecha_apertura"
                            },
                            {
                                "data": "fecha_cierre"
                            },
                            {
                                "data": "ingreso"
                            },
                            {
                                "data": "egreso"
                            },
                            {
                                "data": "saldo_cierre"
                            },
                            {
                                "data": "estado"
                            },
                            {
                                "data": null,
                                "render": function(data, type, row) {
                                    if (row.estado !== 'Cerrado') {
                                        return '<a href="../venta/caja_cerrar.php?id_caja=' + row.id_caja + '" class="submitBotonCerrar">Cerrar</a>';
                                    } else {
                                        return '';
                                    }
                                }
                            },
                            {
                                "data": null,
                                "render": function(data, type, row) {
                                    return '<a href="../venta/borrar_caja.php?id_caja=' + row.id_caja + '&id_usuario=<?php echo $idUsuario; ?>" class="submitBotonEliminar">Borrar</a>';
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