<?php require "../../include/header.php" ?>
<?php require "../../backend/config/baseDeDatos.php"?>
<?php

$usuario = $_SESSION['usuario'];
if (empty($usuario)) {
    header("location:../../index.php");
}
$sql = $conn->query("SELECT factura_cabecera.id_factura, factura_cabecera.fecha_creacion,
            cliente.id_cliente, cliente.nombre FROM factura_cabecera JOIN cliente ON cliente.id_cliente =  factura_cabecera.cliente");
$sql->execute();

$ventaTotal = $sql->fetchAll(PDO::FETCH_OBJ);

?>
    <section id="content">
        <main>
                <div class="left">
                    <nav class="nav">
                        <ul class="breadcrumb">
                            <li>
                                <a class="active" href="../venta/venta.php">Venta</a>
                            </li>
                        </ul>
                        <ul class="breadcrumb">
                            <li>
                                <a class="active" href="./reporte_venta.php">Listado</a>
                            </li>
                        </ul>
                        <ul class="breadcrumb">
                            <li>
                                <a class="active" href="./reporte_factura.php">Facturas</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            <div class="table-data">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <table id="listado" class="table-striped table-bordered" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th>N°</th>
                                        <th>Cliente</th>
                                        <th>Fecha</th>
                                        <th>Editar</th>
                                        <th>Eliminar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1; foreach($ventaTotal as $venta):?>
                                    <tr>
                                        <td><?=$i++?></td>
                                        <td><?=$venta->nombre?></td>
                                        <td><?=$venta->fecha_creacion?></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <?php endforeach;?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </section>
<?php require "../../include/footer.php"; ?>