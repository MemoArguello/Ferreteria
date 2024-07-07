<?php require "../../include/header.php" ?>
<?php require "../../backend/config/baseDeDatos.php"?>
<?php

$usuario = $_SESSION['usuario'];
if (empty($usuario)) {
    header("location:../../index.php");
}
$sql = $conn->query("SELECT proveedores.id_proveedor, proveedores.nombre_prov, proveedores.ruc, proveedores.telefono, departamentos.nombre AS nombre_d, ciudades.nombre AS nombre_c FROM proveedores JOIN departamentos ON departamentos.id_departamento = proveedores.departamento
                    JOIN ciudades ON ciudades.id_ciudad = proveedores.distrito");
$sql->execute();

$proveedorTotal = $sql->fetchAll(PDO::FETCH_OBJ);
?>
    <section id="content">
        <main>
                <div class="left">
                    <nav class="nav">
                        <ul class="breadcrumb">
                            <li>
                                <a class="active" href="./reporte_prov.php">Proveedores</a>
                            </li>
                        </ul>
                        <ul class="breadcrumb">
                            <li>
                                <a class="active" href="../proveedores/agg_proveedor.php">Registrar</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            <div class="table-data">
                <div class="container">
                    <div class="titulo" align="center">
                        <h2>Listado de Proveedores</h2>
                    </div>
                    <div class"row">
                        <div class="col-lg-12">
                            <table id="listado" class="table-striped table-bordered" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Nombre</th>
                                        <th>RUC</th>
                                        <th>Telefono</th>
                                        <th>Departamento</th>
                                        <th>Ciudad</th>
                                        <th>Editar</th>
                                        <th>Eliminar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1; foreach($proveedorTotal as $proveedor):?>
                                    <tr>
                                        <td><?=$i++?></td>
                                        <td><?=$proveedor->nombre_prov?></td>
                                        <td><?=$proveedor->ruc?></td>
                                        <td><?=$proveedor->telefono?></td>
                                        <td><?=$proveedor->nombre_d?></td>
                                        <td><?=$proveedor->nombre_c?></td>
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
