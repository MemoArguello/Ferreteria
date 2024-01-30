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


$resultado1 = mysqli_query($conexiondb, $query1);
$resultado2 = mysqli_query($conexiondb, $query2);
$resultado3 = mysqli_query($conexiondb, $query3);
$resultado4 = mysqli_query($conexiondb, $query4);
$resultado5 = mysqli_query($conexiondb, $query5);
$resultado6 = mysqli_query($conexiondb, $query6);



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link href="../IMG/nut_5361285.png" rel="icon">

</head>

<body>
    <?php
    include($_SERVER['DOCUMENT_ROOT'] . '/Sistema_Ferreteria/Frontend/dashboard/inicio.php');
    ?>
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
            </ul>
            
        </main>
    </section>
    <section>
        
    </section>
    <script src="../dashboard/script.js"></script>

</body>

</html>