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
$id_usuario = $_GET['id_usuario'];
$query_c = "SELECT * FROM cargo";
$resultado_c = mysqli_query($conexiondb, $query_c);
$cargos = mysqli_fetch_row($resultado_c);

$query = "SELECT * FROM usuarios WHERE id_usuario=" . $id_usuario;
$resultado = mysqli_query($conexiondb, $query);
$usuarios = mysqli_fetch_row($resultado);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuracion</title>
    <!----======== CSS ======== -->
    <!----===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="../IMG/nut_5361285.png" rel="icon">
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
			<li>
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
			<li class="">
				<a href="../reportes/reporte_cliente.php">
					<i class='bx bx-group' style='color:#3c91e6'></i>
					<span class="text">Clientes</span>
				</a>
			</li>
		</ul>
		<ul class="side-menu">
			<li class="active">
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
                                <a class="active" href="../reportes/reporte_cuenta.php">Cuentas</a>
                            </li>
                        </ul>
                        <ul class="breadcrumb">
                            <li>
                                <a class="active" href="./registrar_usuario.php">Registrar Cuenta</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            <div class="table-data">
                <div class="container">

                    <form action="../../Backend/cuenta/editar.php" class="formRecepcion" method="POST">
                        <h1 align="center">Registrar Usuario</h1>
                        <div class="row">
                            <div class="col-25">
                                <label for="fname">Correo Electronico</label>
                            </div>
                            <div class="col-75">
                                <input type="text" id="fname" name="correo" value='<?php echo $usuarios[1] ?>'>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-25">
                                <label for="lname">Nombre de Usuario</label>
                            </div>
                            <div class="col-75">
                                <input type="text" id="lname" name="usuario" value='<?php echo $usuarios[2] ?>'>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-25">
                                <label for="country">Cargo</label>
                            </div>
                            <div class="col-75">
                                <?php
                                $query_rol = mysqli_query($conexiondb, "select * FROM cargo");
                                $result_cargo = mysqli_num_rows($query_rol);
                                ?>
                                <select id="" name="id_cargo">
                                    <option value="">Seleccione una opción</option> <!-- Opción en blanco -->
                                    <?php
                                    if ($result_cargo > 0) {
                                        while ($cargo = mysqli_fetch_array($query_rol)) {
                                    ?>
                                            <option value="<?php echo $cargo['id'] ?>"><?php echo $cargo['descripcion'] ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <input type="hidden" name="id_usuario" id="" value='<?php echo $usuarios[0] ?>' readonly>
                            <input type="hidden" name="editar" id="" value='si' readonly>
                            <input type="submit" value="Guardar" class="boton2">
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </section>

    <?php
    mysqli_close($conexiondb);
    ?>
    <script src="../dashboard/script.js"></script>

</body>

</html>