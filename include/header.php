<?php 
session_start();
define("APPURL", "http://localhost/sistema_ferreteria");
define("EMPRESA","ferreteria");

$PaginaActual = basename($_SERVER['PHP_SELF']); // Obtener el nombre del archivo PHP actual

$inicio = ['inicio.php', 'estadisticas.php', 'reporte_auditoria.php'];
$ventas = ['venta.php', 'reporte_venta.php', 'reporte_factura.php'];
$productos = ['reporte_prod.php', 'registrar_productos.php', 'reporte_cat.php', 'registrar_categoria.php','editar_categoria.php'];
$proveedores = ['reporte_prov.php', 'agg_proveedor.php', 'editar_prov.php'];
$caja = ['inicio.php', 'estadisticas.php', 'reporte_auditoria.php'];
$clientes = ['reporte_cliente.php', 'formulario_cliente.php', 'reporte_auditoria.php'];
$configuracion = ['reporte_cuenta.php', 'registrar_usuario.php','editar_cuenta.php' ,'editar_contraseña.php'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= EMPRESA ?></title>
    <link href="<?=APPURL?>/Frontend/IMG/nut_5361285.png" rel="icon">
    <link rel="stylesheet" href="<?=APPURL?>/Frontend/CSS/dash.css">
    <link rel="stylesheet" href="<?=APPURL?>/Frontend/CSS/datatable.css">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.2/css/responsive.bootstrap5.css">
</head>
<body>
<!-- SIDEBAR -->
<section id="sidebar">
    <a href="../inicio/inicio.php" class="brand">
        <i class='bx bxs-store-alt' style='color:#3c91e6'></i>
        <span class="text">Ferreteria</span>
    </a>
    <ul class="side-menu top">
        <li class="<?= in_array($PaginaActual, $inicio) ? 'active' : '' ?>">
            <a href="../inicio/inicio.php">
                <i class='bx bx-home' style='color:#3c91e6'></i>
                <span class="text">Inicio</span>
            </a>
        </li>
        <li class="<?= in_array($PaginaActual, $ventas) ? 'active' : '' ?>">
            <a href="../venta/venta.php">
                <i class='bx bxs-shopping-bag-alt' style='color:#3c91e6'></i>
                <span class="text">Ventas</span>
            </a>
        </li>
        <li class="<?= in_array($PaginaActual, $productos) ? 'active' : '' ?>">
            <a href="../reportes/reporte_prod.php">
                <i class='bx bx-cart' style='color:#3c91e6'></i>
                <span class="text">Productos</span>
            </a>
        </li>
        <li class="<?= in_array($PaginaActual, $proveedores) ? 'active' : '' ?>">
            <a href="../reportes/reporte_prov.php">
                <i class='bx bxs-package' style='color:#3c91e6'></i>
                <span class="text">Proveedores</span>
            </a>
        </li>
        <li class="<?= ($PaginaActual == 'reporte_caja.php') ? 'active' : '' ?>">
            <a href="../reportes/reporte_caja.php">
                <i class='bx bx-dollar-circle' style='color:#3c91e6'></i>
                <span class="text">Caja</span>
            </a>
        </li>
        <li class="<?= in_array($PaginaActual, $clientes) ? 'active' : '' ?>">
            <a href="../reportes/reporte_cliente.php">
                <i class='bx bx-group' style='color:#3c91e6'></i>
                <span class="text">Clientes</span>
            </a>
        </li>
    </ul>
    <ul class="side-menu">
        <li class="<?= in_array($PaginaActual, $configuracion) ? 'active' : '' ?>">
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
<!-- CONTENT -->
<section id="content">
    <!-- NAVBAR -->
    <nav>
        <i class='bx bx-menu sidebar-toggle'></i>
        <form action="#">
            <div class="form-input">
                <input type="search" placeholder="Search...">
                <button type="submit" class="search-btn"><i class='bx bx-search'></i></button>
            </div>
        </form>
        <input type="checkbox" id="switch-mode" hidden>
        <label for="switch-mode" class="switch-mode mode-toggle"></label>
        <a href="#" class="profile">
            <img src="<?=APPURL?>/Frontend/IMG/shopping-bag_5939887.png">
        </a>
    </nav>
</section>



