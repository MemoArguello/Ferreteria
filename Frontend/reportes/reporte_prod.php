<?php
session_start();
include '../../Backend/config/baseDeDatos.php';

$usuario = $_SESSION['usuario'];
if (!isset($usuario)) {
    header("location:../../index.php");
}
$conexiondb = conectardb();
$sql = "SELECT id_cargo FROM `usuarios` WHERE usuario = '$usuario';";
$result = mysqli_query($conexiondb, $sql);
while ($usuario = mysqli_fetch_assoc($result)) {
    if ($usuario['id_cargo'] != 1) {
        header("location:../../index.php");
    }
}
$usuario = $_SESSION['usuario'];
$conexiondb = conectardb();
$query = "SELECT * FROM cargo ORDER BY id ASC";
$resultado = mysqli_query($conexiondb, $query);
mysqli_close($conexiondb);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proveedores</title>
    <link rel="stylesheet" href="../CSS/login.css">
    <link rel="stylesheet" href="../CSS/style.css">
    <link rel="stylesheet" href="../CSS/registrar.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- datatables css basico-->
    <link rel="stylesheet" type="text/css" href="datatables/datatables.min.css">
    <!---datatables bootstrap 4 css-->
    <link rel="stylesheet" type="text/css" href="datatables/DataTables-1.13.1/css/dataTables.bootstrap.css">
</head>

<body>
    <?php
    include($_SERVER['DOCUMENT_ROOT'] . '/Sistema_Ferreteria/Frontend/dashboard/inicio.php');
    ?>
    <section class="dashboard">
        <div class="top">
            <div class="topnav" id="myTopnav">
                <a href="./reporte_prod.php" <?php if (basename($_SERVER['PHP_SELF']) == 'reporte_prod.php') echo 'class="active"'; ?>>Productos</a>
                <a href="../productos/registrar_productos.php" <?php if (basename($_SERVER['PHP_SELF']) == '../productos/registrar_productos') echo 'class="active"'; ?>>Registrar</a>
            </div>
        </div>
        <div class="dash-content">
            <div class="container">
                <div class="texto-formulario">
                    <h2>Listado de Productos</h2>
                </div>
                <div class"row">
                    <div class="col-lg-12">
                        <table id="tablaUsuarios" class="table-striped table-bordered" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Nombre</th>
                                    <th>Categoria</th>
                                    <th>Lote</th>
                                    <th>Stock</th>
                                    <th>Precio</th>
                                    <th>Proveedor</th>
                                    <th>Informacion</th>
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
                        "url": "list_prod.php",
                        "dataSrc": ""
                    },
                    "columns": [{
                            "data": "id_producto"
                        },
                        {
                            "data": "nombre_producto"
                        },
                        {
                            "data": "descripcion"
                        },
                        {
                            "data": "lote"
                        },
                        {
                            "data": "stock"
                        },
                        {
                            "data": "precio"
                        },
                        {
                            "data": "nombre_prov"
                        },
                        {
                            "data": "informacion"
                        },
                        {
                            "data": null,
                            "render": function(data, type, row) {
                                return '<a href="../productos/editar_prod.php?id_producto=' + row.id_producto + '" class="submitBoton">Editar</a>';
                            }
                        },
                        {
                            "data": null,
                            "render": function(data, type, row) {
                                return '<a href="../../Backend/producto/eliminar_prod.php?id_producto=' + row.id_producto + '" class="submitBotonEliminar">Borrar</a>';
                            }
                        }
                    ]
                });
            });
        </script>
        </div>
    </section>
</body>

</html>