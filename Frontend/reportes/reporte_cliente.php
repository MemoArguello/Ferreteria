<?php require "../../include/header.php" ?>
<?php require "../../backend/config/baseDeDatos.php"?>
<?php

$usuario = $_SESSION['usuario'];
if (empty($usuario)) {
    header("location:../../index.php");
}
$sql = $conn->query("SELECT cliente.id_cliente, cliente.cedula, cliente.nombre, cliente.ruc, departamentos.nombre AS nombre_d, ciudades.nombre AS nombre_c FROM cliente JOIN departamentos ON departamentos.id_departamento = cliente.id_departamento
                    JOIN ciudades ON ciudades.id_ciudad = cliente.id_ciudad");
$sql->execute();

$clientes = $sql->fetchAll(PDO::FETCH_OBJ);

?>
    <section id="content">
        <main>
                <div class="left">
                    <nav class="nav">
                        <ul class="breadcrumb">
                            <li>
                                <a class="active" href="./reporte_cliente.php">Clientes</a>
                            </li>
                        </ul>
                        <ul class="breadcrumb">
                            <li>
                                <a class="active" href="../cliente/formulario_cliente.php">Registrar</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            <div class="table-data">
                <div class="container">
                    <div class="titulo" align="center">
                        <h2>Listado de Clientes</h2>
                    </div>
                    <div class"row">
                        <div class="col-lg-12">
                            <table id="listado" class="table table-striped nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>N°</th>
                                        <th>Cedula</th>
                                        <th>Nombre</th>
                                        <th>RUC</th>
                                        <th>Departamento</th>
                                        <th>Ciudad</th>
                                        <th>Editar</th>
                                        <th>Eliminar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $i=1; foreach($clientes as $cliente):?>
                                    <tr>
                                        <td><?=$i++?></td>
                                        <td><?=$cliente->cedula?></td>
                                        <td><?=$cliente->nombre?></td>
                                        <td><?=$cliente->ruc?></td>
                                        <td><?=$cliente->nombre_d?></td>
                                        <td><?=$cliente->nombre_c?></td>
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
