<?php 
session_start();
define("APPURL", "http://localhost/sistema_ferreteria");
define("EMPRESA","ferreteria");

$PaginaActual = basename($_SERVER['PHP_SELF']); // Obtener el nombre del archivo PHP actual
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= EMPRESA ?></title>
    <link href="../IMG/nut_5361285.png" rel="icon">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" href="../CSS/dash.css">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <script src="../path/to/scripts.js" defer></script> <!-- Asegúrate de que la ruta sea correcta -->
</head>
<body>
<!-- SIDEBAR -->
<section id="sidebar">
    <a href="../inicio/inicio.php" class="brand">
        <i class='bx bxs-store-alt' style='color:#3c91e6'></i>
        <span class="text">Ferreteria</span>
    </a>
    <ul class="side-menu top">
        <li class="<?= ($PaginaActual == 'inicio.php') ? 'active' : '' ?>">
            <a href="../inicio/inicio.php">
                <i class='bx bx-home' style='color:#3c91e6'></i>
                <span class="text">Inicio</span>
            </a>
        </li>
        <li class="<?= ($PaginaActual == 'venta.php') ? 'active' : '' ?>">
            <a href="../venta/venta.php">
                <i class='bx bxs-shopping-bag-alt' style='color:#3c91e6'></i>
                <span class="text">Ventas</span>
            </a>
        </li>
        <li class="<?= ($PaginaActual == 'reporte_prod.php') ? 'active' : '' ?>">
            <a href="../reportes/reporte_prod.php">
                <i class='bx bx-cart' style='color:#3c91e6'></i>
                <span class="text">Productos</span>
            </a>
        </li>
        <li class="<?= ($PaginaActual == 'reporte_prov.php') ? 'active' : '' ?>">
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
        <li class="<?= ($PaginaActual == 'reporte_cliente.php') ? 'active' : '' ?>">
            <a href="../reportes/reporte_cliente.php">
                <i class='bx bx-group' style='color:#3c91e6'></i>
                <span class="text">Clientes</span>
            </a>
        </li>
    </ul>
    <ul class="side-menu">
        <li class="<?= ($PaginaActual == 'reporte_cuenta.php') ? 'active' : '' ?>">
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
            <img src="../IMG/shopping-bag_5939887.png">
        </a>
    </nav>
</section>
</body>
</html>

