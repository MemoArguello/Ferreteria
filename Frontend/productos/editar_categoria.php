<?php
require "../../include/header.php";
require '../../Backend/config/baseDeDatos.php';

$usuario = $_SESSION['usuario'];
if (!isset($usuario)) {
    header("location:../../index.php");
}
$query = $conn->query("SELECT * FROM proveedores");
$query->execute();

$resultado = $query->fetchAll(PDO::FETCH_OBJ);

$query2 = $conn->query("SELECT * FROM categorias");
$query2->execute();

$resultado2 = $query2->fetchAll(PDO::FETCH_OBJ);

$id_categoria = $_GET['id'];
$query3 = $conn->query("SELECT categorias.id_categoria, categorias.descripcion FROM categorias where id_categoria = $id_categoria");
$query3->execute();

$resultado3 = $query3->fetch(PDO::FETCH_OBJ);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categoria</title>
    <link href="../IMG/nut_5361285.png" rel="icon">
    <link rel="stylesheet" href="../CSS/dash.css">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <section id="content">
        <main>
            <div class="left">
                <nav class="nav">
                    <ul class="breadcrumb">
                        <li>
                            <a class="active" href="../reportes/reporte_prod.php">Productos</a>
                        </li>
                    </ul>
                    <ul class="breadcrumb">
                        <li>
                            <a class="active" href="./registrar_productos.php">Registrar</a>
                        </li>
                    </ul>
                    <ul class="breadcrumb">
                        <li>
                            <a class="active" href="../reportes/reporte_cat.php">Categorias</a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="table-data">
                <div class="container">

                    <form action="../../Backend/categoria/guardar_categoria.php" class="form_venta" method="POST">
                        <h1 align="center">Editar Categoria</h1>
                        <div class="row">
                            <div class="col-25">
                                <label for="fname">Nombre de la Categoria</label>
                            </div>
                            <div class="col-75">
                                <input type="text" id="fname" name="descripcion" placeholder="" required value='<?php echo $resultado3->descripcion; ?>'>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <input type="hidden" name="id_categoria" id="" value='<?php echo $resultado3->id_categoria; ?>' readonly>
                            <input type="hidden" name="editar" id="" value='si' readonly>
                            <input type="submit" value="Guardar" class="boton2">
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </section>
<?php require "../../include/footer.php" ?>