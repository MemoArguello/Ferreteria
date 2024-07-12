<?php require "../../include/header.php" ?>
<?php require "../../backend/config/baseDeDatos.php"?>
<?php

$usuario = $_SESSION['usuario'];
if (empty($usuario)) {
    header("location:../../index.php");
}
$sql = $conn->query("SELECT factura_cabecera.*, cliente.nombre FROM factura_cabecera 
                    JOIN cliente ON cliente.id_cliente = factura_cabecera.cliente");
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
                                <a class="active" href="./reporte_factura.php">Facturas</a>
                            </li>
                        </ul>
                    </nav>
            </div>
            <div class="table-data">
                <div class="container">
                    <div class="titulo" align="center">
                        <h2>Facturas Generadas</h2>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <table id="listado" class="table-striped table-bordered" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th>N°</th>
                                        <th>Factura</th>
                                        <th>Cliente</th>
                                        <th>Fecha</th>
                                        <th>Factura</th>
                                        <th>Eliminar</i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1; foreach($facturaTotal as $factura):?>
                                    <tr>
                                        <td><?=$i++?></td>
                                        <td><?=$factura->id_factura?></td>
                                        <td><?=$factura->nombre?></td>
                                        <td><?=$factura->fecha_creacion?></td>
                                        <td>
                                            <form action="../venta/RECEIPT/ticket.php" method="POST" target="_blank">
                                                <input type="hidden" name="id" value="<?=$factura->id_factura?>">
                                                <button type="submit" class="submitBotonFactura">
                                                    <i class='bx bxs-file-doc'></i>
                                                </button>
                                            </form>
                                        </td>
                                        <td>
                                            <form action="../../Backend/venta/eliminar_venta.php" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este usuario?');">
                                                <input type="hidden" name="id" value="<?=$factura->id_factura?>">
                                                <button type="submit" class="submitBotonEliminar">
                                                    <i class='bx bx-trash' ></i>
                                                </button>
                                            </form>
                                        </td>
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