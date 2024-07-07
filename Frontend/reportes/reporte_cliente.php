<?php require "../../include/header.php" ?>
<?php require "../../backend/config/baseDeDatos.php"?>
<?php

$usuario = $_SESSION['usuario'];
if (empty($usuario)) {
    header("location:../../index.php");
}
$sql = $conn->query("SELECT id_cargo FROM `usuarios` WHERE usuario = '$usuario'");
$sql->execute();

$query = $conn->query("SELECT * FROM cargo ORDER BY id ASC");
$query->execute();
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
                            <table id="example" class="table table-striped nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Cedula</th>
                                        <th>Nombre</th>
                                        <th>RUC</th>
                                        <th>Departamento</th>
                                        <th>Ciudad</th>
                                        <th>Editar</th>
                                        <th>Eliminar</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </main>
    </section>
<?php require "../../include/footer.php"; ?>
