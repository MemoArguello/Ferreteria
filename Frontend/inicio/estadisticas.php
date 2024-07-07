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

$totalClientes = mysqli_fetch_assoc($resultado1)['total1'];
$totalProductos = mysqli_fetch_assoc($resultado2)['total2'];
$totalVentas = mysqli_fetch_assoc($resultado3)['total3'];
$totalProveedores = mysqli_fetch_assoc($resultado4)['total4'];
$totalVentasGs = mysqli_fetch_assoc($resultado5)['total5'];
$totalComprasGs = mysqli_fetch_assoc($resultado6)['total6'];

$valores = [$totalClientes, $totalProductos, $totalVentas, $totalProveedores];

?>
    <section id="content">
        <main>
                <div class="left">
                    <nav class="nav">
                        <ul class="breadcrumb">
                            <li>
                                <a class="active" href="./inicio.php">Inicio</a>
                            </li>
                        </ul>
                        <ul class="breadcrumb">
                            <li>
                                <a href="./estadisticas.php" <?php if (basename($_SERVER['PHP_SELF']) == 'estadisticas.php') echo 'class="active"'; ?>>Estadisticas</a>
                            </li>
                        </ul>
                        <ul class="breadcrumb">
                            <li>
                                <a class="active" href="../reportes/reporte_auditoria.php">Auditoria</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            <div>
                <canvas id="myChart"></canvas>
            </div>

            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

            <script>
                const ctx = document.getElementById('myChart');

                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ['Clientes', 'Productos', 'Ventas', 'Proveedores'],
                        datasets: [{
                            label: 'Cantidad',
                            data: <?php echo json_encode($valores); ?>,
                            backgroundColor: 'rgba(0, 4, 255, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            </script>
        </main>
        <section>
<?php require "../../include/footer.php"; ?>
