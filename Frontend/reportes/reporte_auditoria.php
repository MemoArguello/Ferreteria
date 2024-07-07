<?php require "../../include/header.php" ?>
<?php require "../../backend/config/baseDeDatos.php"?>
<?php

$usuario = $_SESSION['usuario'];
if (!isset($usuario)) {
    header("location:../../index.php");
}
$auditoria = $conn->query("SELECT auditoria.evento, auditoria.fecha, usuarios.usuario FROM auditoria JOIN usuarios ON usuarios.id_usuario = auditoria.id_usuario");
$auditoria->execute();

$auditoriaTotal = $auditoria->fetchAll(PDO::FETCH_OBJ);
?>
    <section id="content">
        <main>        
                <div class="left">
                    <nav class="nav">
                    <ul class="breadcrumb">
                        <li>
                            <a class="active" href="../inicio/inicio.php">Inicio</a>
                        </li>
                    </ul>
                    <ul class="breadcrumb">
                        <li>
                            <a class="active" href="../inicio/estadisticas.php">Estadisticas</a>
                        </li>
                    </ul>
                    <ul class="breadcrumb">
                        <li>
                            <a class="active" href="../reportes/reporte_auditoria.php">Auditoria</a>
                        </li>
                    </ul>
                    </nav>
                </div>
            <div class="table-data">
                <div class="container">
                    <div class="titulo" align="center">
                        <h1>Registro de Actividades</h1>
                    </div>
                    <div class"row">
                        <div class="col-lg-12">
                            <table id="example" class="table table-striped" style="width:100%">    
                                <thead>
                                    <tr>
                                        <th>N°</th>
                                        <th>Usuario</th>
                                        <th>Actividad</th>
                                        <th>Fecha</th>
                                    </tr>
                                </thead>
                                <?php $i=0; foreach($auditoriaTotal as $auditoria):?>
                                <tbody>
                                    <tr>
                                        <td><?=$i++?></td>
                                        <td><?=$auditoria->usuario?></td>
                                        <td><?=$auditoria->evento?></td>
                                        <td><?=$auditoria->fecha?></td>
                                    </tr>
                                </tbody>
                                <?php endforeach;?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </section>
<?php require "../../include/footer.php"; ?>
