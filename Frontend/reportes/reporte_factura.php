<?php require "../../include/header.php" ?>
<?php require "../../backend/config/baseDeDatos.php"?>
<?php

$usuario = $_SESSION['usuario'];
if (empty($usuario)) {
    header("location:../../index.php");
}
$sql = $conn->query("SELECT detalle_factura.id_detalle, detalle_factura.id_factura, detalle_factura.productos, 
            detalle_factura.cantidad, detalle_factura.costo_unitario, detalle_factura.total, 
            facturas.id_factura, facturas.codigo_factura, facturas.cliente, productos.id_producto,
            productos.nombre_producto, cliente.id_cliente, cliente.nombre, cliente.cedula, detalle_factura.estado 
            FROM detalle_factura JOIN facturas 
            ON facturas.id_factura =  detalle_factura.id_factura JOIN productos 
            ON productos.id_producto = detalle_factura.productos JOIN cliente ON cliente.id_cliente = facturas.cliente");
$sql->execute();

$facturaTotal = $sql->fetchAll(PDO::FETCH_OBJ);
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
                    <div class="titulo" align="center">
                        <h2>Registros de Venta</h2>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <table id="listado" class="table-striped table-bordered" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Factura</th>
                                        <th>Producto</th>
                                        <th>Cliente</th>
                                        <th>Cantidad</th>
                                        <th>Costo Unitario</th>
                                        <th>Total</th>
                                        <th>Estado</th>
                                        <th>Imprimir</th>
                                        <th>Eliminar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1; foreach($facturaTotal as $factura):?>
                                    <tr>
                                        <td><?=$i++?></td>
                                        <td><?=$factura->codigo_factura?></td>
                                        <td><?=$factura->nombre_producto?></td>
                                        <td><?=$factura->nombre?></td>
                                        <td><?=$factura->cantidad?></td>
                                        <td><?=$factura->costo_unitario?></td>
                                        <td><?=$factura->total?></td>
                                        <td><?=$factura->estado?></td>
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
            </div>
        </main>
    </section>
<?php require "../../include/footer.php"; ?>