<?php require "../../include/header.php" ?>
<?php require "../../backend/config/baseDeDatos.php"?>
<?php

$usuario = $_SESSION['usuario'];
if (empty($usuario)) {
    header("location:../../index.php");
}
$sql = $conn->query("SELECT * FROM caja");
$sql->execute();

$cajaTotal = $sql->fetchAll(PDO::FETCH_OBJ);

?>
    <section id="content">
        <main>
            <div class="left">
                <nav class="nav">
                    <ul class="breadcrumb">
                        <li>
                            <a class="active" href="./reporte_caja.php">Cajas</a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="table-data">
                <div class="container">
                    <div class="titulo" align="center">
                        <h2>Cajas</h2>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <table id="listado" class="table-striped table-bordered" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Fecha Apertura</th>
                                        <th>Fecha Cierre</th>
                                        <th>Ingreso</th>
                                        <th>Egreso</th>
                                        <th>Saldo_cierre</th>
                                        <th>Estado</th>
                                        <th>Cerrar Caja</th>
                                        <th>Eliminar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1; foreach($cajaTotal as $caja):?>
                                    <tr>
                                        <td><?=$i++?></td>
                                        <td><?=$caja->fecha_apertura?></td>
                                        <td><?=$caja->fecha_cierre?></td>
                                        <td><?=$caja->ingreso?></td>
                                        <td><?=$caja->egreso?></td>
                                        <td><?=$caja->saldo_cierre?></td>
                                        <td><?=$caja->estado?></td>
                                        <th></th>
                                        <th></th>
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
