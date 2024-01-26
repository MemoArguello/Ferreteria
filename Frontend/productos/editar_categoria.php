<?php
session_start();
include '../../Backend/config/baseDeDatos.php';

$usuario = $_SESSION['usuario'];
if (!isset($usuario)) {
    header("location:../../index.php");
}
$conexiondb = conectardb();
$query = "SELECT * FROM proveedores";
$resultado = mysqli_query($conexiondb, $query);

$query2 = "SELECT * FROM categorias";
$resultado2 = mysqli_query($conexiondb, $query2);

$sql = "SELECT id_cargo FROM `usuarios` WHERE usuario = '$usuario';";
$result = mysqli_query($conexiondb, $sql);

$usuario = $_SESSION['usuario'];

$id_categoria = $_GET['id_categoria'];
$query3 ="SELECT categorias.id_categoria, categorias.descripcion FROM categorias where id_categoria = $id_categoria";
$resultado3 = mysqli_query($conexiondb, $query3);
$categoria = mysqli_fetch_row($resultado3);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categoria</title>
    <link rel="stylesheet" href="../CSS/style.css">
    <link rel="stylesheet" href="../CSS/stiles.css">
    <link rel="stylesheet" href="../CSS/registrar.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<?php 
        include($_SERVER['DOCUMENT_ROOT'] . '/Sistema_Ferreteria/Frontend/dashboard/inicio.php');
    ?>
        <section class="dashboard">
        <div class="top">
            <div class="topnav" id="myTopnav">
                <a href="../reportes/reporte_prod.php" <?php if (basename($_SERVER['PHP_SELF']) == '../reportes/reporte_prov') echo 'class="active"'; ?>>Productos</a>
                <a href="./registrar_productos.php" <?php if (basename($_SERVER['PHP_SELF']) == 'registrar_productos.php') echo 'class="active"'; ?>>Registrar</a>
                <a href="../reportes/reporte_cat.php" <?php if (basename($_SERVER['PHP_SELF']) == 'reporte_cat.php') echo 'class="active"'; ?>>Categorias</a>
            </div>
        </div>

        <div class="dash-content">
            <form action="../../Backend/categoria/guardar_categoria.php" class="form_venta" method="POST">
                <h1 align="center">Editar Categoria</h1>
                <div class="row">
                    <div class="col-25">
                        <label for="fname">Nombre de la Categoria</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="fname" name="descripcion" placeholder="" required value='<?php echo $categoria[1]; ?>'>
                    </div>
                </div>
                <br>
                <div class="row">
                    <input type="hidden" name="id_categoria" id="" value='<?php echo $categoria[0]; ?>' readonly>
                    <input type="hidden" name="editar" id="" value='si' readonly>
                    <input type="submit" value="Guardar">
                </div>
            </form>
        </div>
    </section>
</body>
</html>