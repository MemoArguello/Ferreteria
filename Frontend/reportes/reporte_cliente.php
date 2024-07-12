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
                    <ul class="pdf">
                        <li>
                            <a class="active" href="PDF/pdf_cliente.php" target="_blank">Reporte PDF</a>
                        </li>
                    </ul>
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
                                        <th>Borrar</th>
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
                                        <td>
                                        <a class="submitBotonEditar" href="../cliente/editar_cliente.php?id=<?=$cliente->id_cliente?>">
                                            <i class='bx bx-edit'></i>
                                        </a>
                                    </td>
                                    <td>
                                        <form action="../../Backend/cliente/eliminar_cliente.php" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este usuario?');">
                                            <input type="hidden" name="id" value="<?=$cliente->id_cliente?>">
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
