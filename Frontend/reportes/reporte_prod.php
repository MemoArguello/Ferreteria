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
    <title>Productos</title>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- datatables css basico-->
    <link rel="stylesheet" type="text/css" href="datatables/datatables.min.css">
    <!---datatables bootstrap 4 css-->
    <link rel="stylesheet" type="text/css" href="datatables/DataTables-1.13.1/css/dataTables.bootstrap.css">
    <link href="../IMG/nut_5361285.png" rel="icon">
    <link rel="stylesheet" href="../CSS/dash.css">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <style>
        table.dataTable thead {
            background: linear-gradient(to right, #8593ff, #79ace9);
            color: white;
        }
    </style>
</head>

<body>
    	<!-- SIDEBAR -->
        <section id="sidebar">
		<a href="../inicio/inicio.php" class="brand">
			<i class='bx bxs-store-alt' style='color:#3c91e6'></i>
			<span class="text">Ferreteria</span>
		</a>
		<ul class="side-menu top">
			<li class="">
				<a href="../inicio/inicio.php">
					<i class='bx bx-home' style='color:#3c91e6'></i>
					<span class="text">Inicio</span>
				</a>
			</li>
			<li>
				<a href="../venta/venta.php">
					<i class='bx bxs-shopping-bag-alt' style='color:#3c91e6'></i>
					<span class="text">Ventas</span>
				</a>
			</li>
			<li class="active">
				<a href="../reportes/reporte_prod.php">
					<i class='bx bx-cart' style='color:#3c91e6'></i>
					<span class="text">Productos</span>
				</a>
			</li>
			<li>
				<a href="../reportes/reporte_prov.php">
					<i class='bx bxs-package' style='color:#3c91e6'></i>
					<span class="text">Proveedores</span>
				</a>
			</li>
			<li class="">
				<a href="../reportes/reporte_caja.php">
						<i class='bx bx-dollar-circle' style='color:#3c91e6'></i>
						<span class="text">Caja</span>
				</a>
			</li>
			<li>
				<a href="../reportes/reporte_cliente.php">
					<i class='bx bx-group' style='color:#3c91e6'></i>
					<span class="text">Clientes</span>
				</a>
			</li>
		</ul>
		<ul class="side-menu">
			<li>
				<a href="../reportes/reporte_cuenta.php">
					<i class='bx bxs-cog' style='color:#3c91e6'></i>
					<span class="text">Configuracion</span>
				</a>
			</li>
			<li>
				<a href="../../Backend/validacion/cerrar_sesion.php" class="logout">
					<i class='bx bxs-log-out-circle'></i>
					<span class="text">Cerrar Sesión</span>
				</a>
			</li>
		</ul>
	</section>
	<!-- SIDEBAR -->
	<!-- CONTENT -->
	<section id="content">
		<!-- NAVBAR -->
		<nav>
			<i class='bx bx-menu'></i>
			<form action="#">
				<div class="form-input">
					<input type="search" placeholder="Search...">
					<button type="submit" class="search-btn"><i class='bx bx-search'></i></button>
				</div>
			</form>
			<input type="checkbox" id="switch-mode" hidden>
			<label for="switch-mode" class="switch-mode"></label>
			<a href="#" class="profile">
				<img src="../IMG/shopping-bag_5939887.png">
			</a>
		</nav>
	</section>
    <section id="content">
    <main>
                <div class="left">
                    <nav class="nav">
                        <ul class="breadcrumb">
                            <li>
                                <a class="active" href="./reporte_prod.php">Productos</a>
                            </li>
                        </ul>
                        <ul class="breadcrumb">
                            <li>
                                <a class="active" href="../productos/registrar_productos.php">Registrar</a>
                            </li>
                        </ul>
                        <ul class="breadcrumb">
                            <li>
                                <a class="active" href="./reporte_cat.php">Categorias</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            <div class="table-data">
            <div class="container">
                <div class="titulo" align="center">
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
                                    <th>Precio Venta</th>
                                    <th>Precio Compra</th>
                                    <th>Proveedor</th>
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
                                columns: [0, 1, 2, 3, 4, 5, 7, 8]
                            }
                        },
                        {
                            extend: 'pdfHtml5',
                            text: 'PDF',
                            titleAttr: 'Exportar a PDF',
                            className: 'btn btn-danger',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5, 7, 8]
                            }
                        },
                        {
                            extend: 'print',
                            text: 'Imprimir',
                            titleAttr: 'Imprimir',
                            className: 'btn btn-info',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5, 7, 8]
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
                            "data": "precio_compra"
                        },
                        {
                            "data": "nombre_prov"
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
        </main>
    </section>
    <script src="../dashboard/script.js"></script>
</body>
</html>