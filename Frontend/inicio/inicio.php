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
$query1 = "SELECT COUNT(*) total1 FROM cliente";
$query2 = "SELECT COUNT(*) total2 FROM productos";
$query3 = "SELECT COUNT(*) total3 FROM facturas";
$query4 = "SELECT COUNT(*) total4 FROM proveedores";
$query5 = "SELECT sum(ingreso) total5 FROM caja";
$query6 = "SELECT sum(egreso) total6 FROM caja";
$query7 = "SELECT COUNT(*) total7 FROM auditoria";
$query8 = "SELECT COUNT(*) total8 FROM usuarios";


$resultado1 = mysqli_query($conexiondb, $query1);
$resultado2 = mysqli_query($conexiondb, $query2);
$resultado3 = mysqli_query($conexiondb, $query3);
$resultado4 = mysqli_query($conexiondb, $query4);
$resultado5 = mysqli_query($conexiondb, $query5);
$resultado6 = mysqli_query($conexiondb, $query6);
$resultado7 = mysqli_query($conexiondb, $query7);
$resultado8 = mysqli_query($conexiondb, $query8);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
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
			<li class="active">
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
                        <ul class="">
                            <li>
                                <a href="./inicio.php" <?php if (basename($_SERVER['PHP_SELF']) == 'inicio.php') echo 'class="active"'; ?>>Inicio</a>
                            </li>
                        </ul>
                        <ul class="">
                            <li>
                                <a href="./estadisticas.php" <?php if (basename($_SERVER['PHP_SELF']) == 'estadisticas.php') echo 'class="active"'; ?>>Estadisticas</a>
                            </li>
                        </ul>
                        <ul class="">
                            <li>
                                <a href="../reportes/reporte_auditoria.php" <?php if (basename($_SERVER['PHP_SELF']) == 'reporte_auditoria.php') echo 'class="active"'; ?>>Auditoria</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            <ul class="box-info">
                <li>
                    <img src="../IMG/rating_5939760.png" alt="" class="card ">
                    <span class="text">
                        <?php
                        while ($reserva = mysqli_fetch_assoc($resultado1)) {
                            if ($reserva['total1'] == '1') {
                                echo "<h3>" . $reserva['total1'] . "</h3>";
                                echo "<p>Cliente Registrado</p>";
                            } else {
                                echo "<h3>" . $reserva['total1'] . "</h3>";
                                echo "<p>Clientes Registrados</p>";
                            }
                        }
                        ?>
                    </span>
                </li>
                <li>
                    <img src="../IMG/boxes_6691160.png" alt="" class="card">
                    <span class="text">
                        <?php
                        while ($reserva = mysqli_fetch_assoc($resultado2)) {
                            if ($reserva['total2'] == 1) {
                                echo "<h3>" . $reserva['total2'] . "</h3>";
                                echo "<p>Producto Registrado</p>";
                            } else {
                                echo "<h3>" . $reserva['total2'] . "</h3>";
                                echo "<p>Productos Registrados</p>";
                            }
                        }
                        ?>
                    </span>
                </li>
                <li>
                    <img src="../IMG/dollar_2542439.png" alt="" class="card">
                    <span class="text">
                        <?php
                        while ($reserva = mysqli_fetch_assoc($resultado3)) {
                            if ($reserva['total3'] == 1) {
                                echo "<h3>" . $reserva['total3'] . "</h3>";
                                echo "<p>Venta Realizado</p>";
                            } else {
                                echo "<h3>" . $reserva['total3'] . "</h3>";
                                echo "<p>Ventas Realizadas</p>";
                            }
                        }
                        ?>
                    </span>
                </li>
                <li>
                    <img src="../IMG/warehouse_12766209.png" alt="" class="card">
                    <span class="text">
                        <?php
                        while ($reserva = mysqli_fetch_assoc($resultado4)) {
                            if ($reserva['total4'] == 1) {
                                echo "<h3>" . $reserva['total4'] . "</h3>";
                                echo "<p>Proveedor Registrado</p>";
                            } else {
                                echo "<h3>" . $reserva['total4'] . "</h3>";
                                echo "<p>Proveedores Registrados</p>";
                            }
                        }
                        ?>
                    </span>
                </li>
                <li>
                    <img src="../IMG/building_2542451.png" alt="" class="card">
                    <span class="text">
                        <?php
                        while ($reserva = mysqli_fetch_assoc($resultado5)) {
                            echo "<h3>" . $reserva['total5'] . "</h3>";
                            echo "<p>Gs en Ventas Realizadas</p>";
                        }
                        ?>
                    </span>
                </li>
                <li>
                    <img src="../IMG/shopping-bag_5939887.png" alt="" class="card">
                    <span class="text">
                        <?php
                        while ($reserva = mysqli_fetch_assoc($resultado6)) {
                            echo "<h3>" . $reserva['total6'] . "</h3>";
                            echo "<p>Gs en Compras Realizadas</p>";
                        }
                        ?>
                    </span>
                </li>
                <li>
                    <img src="../IMG/website_5939821.png" alt="" class="card">
                    <span class="text">
                        <?php
                        while ($reserva = mysqli_fetch_assoc($resultado7)) {
                            if ($reserva['total7'] == 1) {
                                echo "<h3>" . $reserva['total7'] . "</h3>";
                                echo "<p>Actividad Registrada</p>";
                            } else {
                                echo "<h3>" . $reserva['total7'] . "</h3>";
                                echo "<p>Actividades Registradas</p>";
                            }
                        }                       
                        ?>
                    </span>
                </li>
                <li>
                    <img src="../IMG/member-card_5939951.png" alt="" class="card">
                    <span class="text">
                        <?php
                        while ($reserva = mysqli_fetch_assoc($resultado8)) {
                            if ($reserva['total8'] == 1) {
                                echo "<h3>" . $reserva['total8'] . "</h3>";
                                echo "<p>Usuario Registrado</p>";
                            } else {
                                echo "<h3>" . $reserva['total8'] . "</h3>";
                                echo "<p>Usuarios Registrados</p>";
                            }
                        }
                        ?>
                    </span>
                </li>
            </ul>
            
        </main>
    </section>
    <section>
        
    </section>
    <script src="../dashboard/script.js"></script>

</body>

</html>