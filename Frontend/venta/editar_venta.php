<?php
session_start();
include '../../Backend/config/baseDeDatos.php';

$usuario = $_SESSION['usuario'];
if (!isset($usuario)) {
    header("location:../../index.php");
}
$conexiondb = conectardb();
$query3 = "SELECT * FROM departamentos ORDER BY id_departamento";
$resultado = mysqli_query($conexiondb, $query3);

$query2 = "SELECT * FROM ciudades WHERE id_departamento = 'id_departamento'";
$resultado2 = mysqli_query($conexiondb, $query2);

$sql = "SELECT id_cargo FROM `usuarios` WHERE usuario = '$usuario';";
$result = mysqli_query($conexiondb, $sql);

$usuario = $_SESSION['usuario'];

$id_factura = $_GET['id_factura'];
$query = "SELECT facturas.id_factura, facturas.codigo_factura, cliente.nombre, facturas.tipo, facturas.fecha_creacion,
         cliente.id_cliente FROM facturas JOIN cliente ON cliente.id_cliente =  facturas.cliente WHERE id_factura =" . $id_factura;
$resultado3 = mysqli_query($conexiondb, $query);

$venta = mysqli_fetch_row($resultado3);
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
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ventas</title>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link href="../IMG/nut_5361285.png" rel="icon">
    <script>
        function getCiudades(departamentoId) {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("ciudad").innerHTML = this.responseText;
                }
            };
            xhttp.open("GET", "get_ciudades.php?departamento_id=" + departamentoId, true);
            xhttp.send();
        }
    </script>
    <link rel="stylesheet" href="../CSS/dash.css">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
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
			<li class="active">
				<a href="../venta/venta.php">
					<i class='bx bxs-shopping-bag-alt' style='color:#3c91e6'></i>
					<span class="text">Ventas</span>
				</a>
			</li>
			<li class="">
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
                                <a class="active" href="./venta.php">Venta</a>
                            </li>
                        </ul>
                        <ul class="breadcrumb">
                            <li>
                                <a class="active" href="../reportes/reporte_venta.php">Listado</a>
                            </li>
                        </ul>
                        <ul class="breadcrumb">
                            <li>
                                <a class="active" href="../reportes/reporte_factura.php">Facturas</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            <div class="table-data">
                <div class="container">
                    <form action="../../Backend/venta/guardar_venta.php" class="formRecepcion" method="POST">
                        <h1 class="titulo" align="center">Editar Venta</h1>
                        <div class="row">
                            <div class="col-25">
                                <label for="fname">Codigo de Factura</label>
                            </div>
                            <div class="col-75">
                                <input type="text" id="fname" name="codigo_factura" placeholder="" required value='<?php echo $venta[1]; ?>'>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-25">
                                <label for="lname">Cliente</label>
                            </div>
                            <div class="col-75">
                                <input type="text" id="lname" name="cliente" placeholder="" required value='<?php echo $venta[2]; ?>' readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-25">
                                <label for="tipo">Tipo:</label>
                            </div>
                            <div class="col-75">
                                <select name="tipo" required>
                                    <option value="">Seleccione una opción</option>
                                    <option value="Productos">Productos</option>
                                    <option value="Servicios">Servicios</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-25">
                                <label for="lname">Fecha</label>
                            </div>
                            <div class="col-75">
                                <input type="date" id="date" name="fecha_creacion" placeholder="" required value='<?php echo $venta[4]; ?>'>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <input type="hidden" name="id_usuario" id="" value='<?php echo $idUsuario[0]; ?>' readonly>
                            <input type="hidden" name="id_factura" id="" value='<?php echo $venta[0]; ?>' readonly>
                            <input type="hidden" name="editar" id="" value='si' readonly>
                            <input type="submit" value="Guardar" class="boton2">
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </section>
    <script src="../dashboard/script.js"></script>

</body>

</html>