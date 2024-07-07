<?php 
require "../../include/header.php";
require "../../backend/config/baseDeDatos.php";

$usuario = $_SESSION['usuario'];
if (empty($usuario)) {
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
                            <a class="active" href="../inicio/estadisticas.php">Estadísticas</a>
                        </li>
                    </ul>
                    <ul class="breadcrumb">
                        <li>
                            <a class="active" href="../reportes/reporte_auditoria.php">Auditoría</a>
                        </li>
                    </ul>
                    </nav>
                </div>
            <div class="table-data">
                <div class="">
                    <div class="titulo" align="center">
                        <h1>Registro de Actividades</h1>
                    </div>
                    <table id="listado" class="table table-striped nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Usuario</th>
                                <th>Actividad</th>
                                <th>Fecha</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=1; foreach($auditoriaTotal as $auditoria):?>
                            <tr>
                                <td><?=$i++?></td>
                                <td><?=$auditoria->usuario?></td>
                                <td><?=$auditoria->evento?></td>
                                <td><?=$auditoria->fecha?></td>
                            </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </section>
<?php require "../../include/footer.php"; ?>
