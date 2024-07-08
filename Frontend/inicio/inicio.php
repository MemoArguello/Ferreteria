<?php 
require "../../include/header.php"; 
require "../../backend/config/baseDeDatos.php";


if(!isset($_SESSION['usuario'])){
    header("location:../../index.php");
    exit(); 
}

$usuario = $_SESSION['usuario'];

$sql = $conn->query("SELECT id_cargo FROM `usuarios` WHERE usuario = '$usuario';");
$sql->execute();

$query1 = $conn->query("SELECT COUNT(*) total1 FROM cliente");
$query2 = $conn->query("SELECT COUNT(*) total2 FROM productos");
$query3 = $conn->query("SELECT COUNT(*) total3 FROM facturas");
$query4 = $conn->query("SELECT COUNT(*) total4 FROM proveedores");
$query5 = $conn->query("SELECT sum(ingreso) total5 FROM caja");
$query6 = $conn->query("SELECT sum(egreso) total6 FROM caja");
$query7 = $conn->query("SELECT COUNT(*) total7 FROM auditoria");
$query8 = $conn->query("SELECT COUNT(*) total8 FROM usuarios");

$query1->execute();
$query2->execute();
$query3->execute();
$query4->execute();
$query5->execute();
$query6->execute();
$query7->execute();
$query8->execute();

$resultado1 = $query1->fetch(PDO::FETCH_ASSOC);
$resultado2 = $query2->fetch(PDO::FETCH_ASSOC);
$resultado3 = $query3->fetch(PDO::FETCH_ASSOC);
$resultado4 = $query4->fetch(PDO::FETCH_ASSOC);
$resultado5 = $query5->fetch(PDO::FETCH_ASSOC);
$resultado6 = $query6->fetch(PDO::FETCH_ASSOC);
$resultado7 = $query7->fetch(PDO::FETCH_ASSOC);
$resultado8 = $query8->fetch(PDO::FETCH_ASSOC);

?>

<!-- SIDEBAR -->
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
            <li>
                <img src="../IMG/rating_5939760.png" alt="" class="card ">
                <span class="text">
                    <h3><?= $resultado1['total1'] ?></h3>
                    <p><?= $resultado1['total1'] == 1 ? 'Cliente Registrado' : 'Clientes Registrados' ?></p>
                </span>
            </li>
            <li>
                <img src="../IMG/boxes_6691160.png" alt="" class="card">
                <span class="text">
                    <h3><?= $resultado2['total2'] ?></h3>
                    <p><?= $resultado2['total2'] == 1 ? 'Producto Registrado' : 'Productos Registrados' ?></p>
                </span>
            </li>
            <li>
                <img src="../IMG/dollar_2542439.png" alt="" class="card">
                <span class="text">
                    <h3><?= $resultado3['total3'] ?></h3>
                    <p><?= $resultado3['total3'] == 1 ? 'Venta Realizada' : 'Ventas Realizadas' ?></p>
                </span>
            </li>
            <li>
                <img src="../IMG/warehouse_12766209.png" alt="" class="card">
                <span class="text">
                    <h3><?= $resultado4['total4'] ?></h3>
                    <p><?= $resultado4['total4'] == 1 ? 'Proveedor Registrado' : 'Proveedores Registrados' ?></p>
                </span>
            </li>
            <li>
                <img src="../IMG/building_2542451.png" alt="" class="card">
                <span class="text">
                    <h3><?= $resultado5['total5'] ?></h3>
                    <p>Gs en Ventas Realizadas</p>
                </span>
            </li>
            <li>
                <img src="../IMG/shopping-bag_5939887.png" alt="" class="card">
                <span class="text">
                    <h3><?= $resultado6['total6'] ?></h3>
                    <p>Gs en Compras Realizadas</p>
                </span>
            </li>
            <li>
                <img src="../IMG/website_5939821.png" alt="" class="card">
                <span class="text">
                    <h3><?= $resultado7['total7'] ?></h3>
                    <p><?= $resultado7['total7'] == 1 ? 'Actividad Registrada' : 'Actividades Registradas' ?></p>
                </span>
            </li>
            <li>
                <img src="../IMG/member-card_5939951.png" alt="" class="card">
                <span class="text">
                    <h3><?= $resultado8['total8'] ?></h3>
                    <p><?= $resultado8['total8'] == 1 ? 'Usuario Registrado' : 'Usuarios Registrados' ?></p>
                </span>
            </li>
        </ul>
    </main>
</section>
<?php require "../../include/footer.php"; ?>
