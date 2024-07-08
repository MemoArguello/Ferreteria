<?php require "../../include/header.php" ?>
<?php require "../../backend/config/baseDeDatos.php"?>
<?php


$usuario = $_SESSION['usuario'];
if (empty($usuario)) {
    header("location:../../index.php");
}
$sql = $conn->query("SELECT * FROM categorias");
$sql->execute();

$categoriaTotal = $sql->fetchAll(PDO::FETCH_OBJ);
?>
    <section id="content">
        <main>
                <div class="left">
                    <nav class="nav">
                    <ul class="breadcrumb">
                        <li>
                            <a class="active" href="./reporte_prod.php">Productos</a>
                        </li>
                    </ul>
                    <ul class="breadcrumb">
                        <li>
                            <a class="active" href="../productos/registrar_productos.php">Registrar</a>
                        </li>
                    </ul>
                    <ul class="breadcrumb">
                        <li>
                            <a class="active" href="./reporte_cat.php">Categorias</a>
                        </li>
                    </ul>
                    </nav>
                </div>
        <div class="table-data">
            <div class="container">
                <div class="titulo" align="center">
                    <h2>Listado de Categorias</h2>
                </div>
                <ul class="menu">
                        <li>
                            <a class="active" href="../productos/registrar_categoria.php">Registrar</a>
                        </li>
                </ul>
                <ul class="pdf">
                        <li>
                            <a class="active" href="./reporte_cat.php">Reporte PDF</a>
                        </li>
                </ul>
                <div class"row">
                    <div class="col-lg-12">
                        <table id="listado" class="table-striped table-bordered" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Categoria</th>
                                    <th>Editar</th>
                                    <th>Eliminar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1; foreach($categoriaTotal as $categoria):?>
                                    <tr>
                                        <td><?=$i++?></td>
                                        <td><?=$categoria->descripcion?></td>
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