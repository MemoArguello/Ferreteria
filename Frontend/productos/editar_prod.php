<?php
session_start();
include '../../Backend/config/baseDeDatos.php';

$usuario = $_SESSION['usuario'];
if (!isset($usuario)) {
    header("location:../../index.php");
}
$conexiondb = conectardb();
$query = "SELECT * FROM proveedores";
$resultado = mysqli_query($conexiondb, $query);

$query2 = "SELECT * FROM categorias";
$resultado2 = mysqli_query($conexiondb, $query2);

$sql = "SELECT id_cargo FROM `usuarios` WHERE usuario = '$usuario';";
$result = mysqli_query($conexiondb, $sql);

$usuario = $_SESSION['usuario'];

$id_producto = $_GET['id_producto'];
$query3 = "SELECT productos.id_producto, productos.nombre_producto, productos.categoria, 
        productos.lote, productos.stock, productos.precio, productos.precio_compra,
        proveedores.id_proveedor, proveedores.nombre_prov, categorias.id_categoria, categorias.descripcion
        FROM productos JOIN proveedores
        ON proveedores.id_proveedor = productos.id_proveedor 
        JOIN categorias ON categorias.id_categoria = productos.categoria where id_producto = $id_producto";
$resultado3 = mysqli_query($conexiondb, $query3);
$producto = mysqli_fetch_row($resultado3);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <link rel="stylesheet" href="../CSS/dash.css">
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
                            <a class="active" href="../reportes/reporte_prod.php">Productos</a>
                        </li>
                    </ul>
                    <ul class="breadcrumb">
                        <li>
                            <a class="active" href="./registrar_productos.php">Registrar</a>
                        </li>
                    </ul>
                    <ul class="breadcrumb">
                        <li>
                            <a class="active" href="../reportes/reporte_cat.php">Categorias</a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="table-data">
                <div class="container">
                    <form action="../../Backend/producto/guardar_product.php" class="form_vent" method="POST">
                        <h1 align="center">Editar Producto</h1>
                        <div class="row">
                            <div class="col-25">
                                <label for="fname">Nombre del Producto</label>
                            </div>
                            <div class="col-75">
                                <input type="text" id="fname" name="nombre_producto" placeholder="" required value='<?php echo $producto[1]; ?>'>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-25">
                                <label for="country">Categoria</label>
                            </div>
                            <div class="col-75">
                                <select id="proveedor" name="categoria" required>
                                    <option value="">Seleccione una opción</option>
                                    <?php
                                    while ($categoria = mysqli_fetch_assoc($resultado2)) {
                                        echo "<option value='" . $categoria['id_categoria'] . "'>" . $categoria['descripcion'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-25">
                                <label for="lname">Lote</label>
                            </div>
                            <div class="col-75">
                                <input type="text" id="lname" name="lote" placeholder="" required value='<?php echo $producto[3]; ?>'>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-25">
                                <label for="lname">Stock</label>
                            </div>
                            <div class="col-75">
                                <input type="number" id="lname" name="stock" placeholder="" required value='<?php echo $producto[4]; ?>'>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-25">
                                <label for="lname">Precio de Venta</label>
                            </div>
                            <div class="col-75">
                                <input type="number" id="lname" name="precio" placeholder="" required value='<?php echo $producto[5]; ?>'>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-25">
                                <label for="lname">Precio de Compra</label>
                            </div>
                            <div class="col-75">
                                <input type="number" id="lname" name="precio_compra" placeholder="" required value='<?php echo $producto[6]; ?>'>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-25">
                                <label for="country">Proveedor</label>
                            </div>
                            <div class="col-75">
                                <select id="proveedor" name="id_proveedor" onchange="getCiudades(this.value)" required>
                                    <option value="">Seleccione una opción</option>
                                    <?php
                                    while ($proveedor = mysqli_fetch_assoc($resultado)) {
                                        echo "<option value='" . $proveedor['id_proveedor'] . "'>" . $proveedor['nombre_prov'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <input type="hidden" name="id_producto" id="" value='<?php echo $producto[0]; ?>' readonly>
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