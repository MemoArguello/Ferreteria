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
$query1 = "SELECT COUNT(*) total1 FROM cargo";
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
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" href="../CSS/style.css">
    <link rel="stylesheet" href="../CSS/stiles.css">
    <link rel="stylesheet" href="../CSS/registrar.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.min.js" integrity="sha512-L0Shl7nXXzIlBSUUPpxrokqq4ojqgZFQczTYlGjzONGTDAcLremjwaWv5A+EDLnxhQzY5xUZPWLOLqYRkY0Cbw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>

</head>

<body>
    <?php
    include($_SERVER['DOCUMENT_ROOT'] . '/Sistema_Ferreteria/Frontend/dashboard/inicio.php');
    ?>
    <section class="dashboard">
        <div class="top">
            <div class="topnav" id="myTopnav">
                <a href="./inicio.php" <?php if (basename($_SERVER['PHP_SELF']) == 'inicio.php') echo 'class="active"'; ?>>Inicio</a>
                <a href="./estadisticas.php" <?php if (basename($_SERVER['PHP_SELF']) == 'estadisticas.php') echo 'class="active"'; ?>>Estadisticas</a>
                <a href="../reportes/reporte_auditoria.php" <?php if (basename($_SERVER['PHP_SELF']) == 'formulario_cliente.php') echo 'class="active"'; ?>>Auditoria</a>
            </div>
        </div>
        <br>
        <div class="dash-content">

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
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
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
        </div>
        <section>
</body>

</html>