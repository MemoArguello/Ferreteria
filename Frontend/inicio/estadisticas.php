<?php require "../../include/header.php" ?>
<?php require "../../backend/config/baseDeDatos.php"?>
<?php

$usuario = $_SESSION['usuario'];
if (!isset($usuario)) {
    header("location:../../index.php");
}

$queries = [
    "SELECT COUNT(*) total1 FROM cliente",
    "SELECT COUNT(*) total2 FROM productos",
    "SELECT COUNT(*) total3 FROM facturas",
    "SELECT COUNT(*) total4 FROM proveedores",
    "SELECT sum(ingreso) total5 FROM caja",
    "SELECT sum(egreso) total6 FROM caja"
];

$valores = [];
foreach ($queries as $query) {
    $stmt = $conn->query($query);
    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
    $valores[] = array_values($resultado)[0];
}

$totalClientes = $valores[0];
$totalProductos = $valores[1];
$totalVentas = $valores[2];
$totalProveedores = $valores[3];
$totalVentasGs = $valores[4];
$totalComprasGs = $valores[5];
?>


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
                <ul class="box-info">
                    <div>
                        <canvas id="myChart"></canvas>
                    </div>
                </ul>

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
