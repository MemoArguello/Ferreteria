<?php require "../../include/header.php" ?>
<?php require "../../backend/config/baseDeDatos.php"?>
<?php

$usuario = $_SESSION['usuario'];
if (!isset($usuario)) {
    header("location:../../index.php");
}

    //obtener usuario para auditoria
    $consulta= $conn->query("SELECT id_usuario FROM usuarios where usuario ='$usuario'");
    $consulta->execute();
    
    $resultado3 =$consulta->fetch(PDO::FETCH_ASSOC);
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
                        <h1 align="center">Registrar Categoria</h1>
                        <div class="row">
                            <div class="col-25">
                                <label for="fname">Nombre de la Categoria</label>
                            </div>
                            <div class="col-75">
                                <input type="text" id="fname" name="descripcion" placeholder="" required>
                            </div>
                        </div>
                        <br>
                        <div class="row">
							<input type="hidden" name="id_usuario" id="" value='<?= $resultado3['id_usuario'] ?>' readonly>
                            <input type="hidden" name="editar" id="" value='no' readonly>
                            <input type="submit" value="Guardar" class="boton2">
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </section>
    <script src="../dashboard/script.js"></script>

</body>

</html>