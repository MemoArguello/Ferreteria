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

$id_caja = $_GET['id_caja'];
$query3 ="SELECT caja.id_caja,  caja.ingreso, caja.egreso FROM caja where id_caja = $id_caja";
$resultado3 = mysqli_query($conexiondb, $query3);
$caja = mysqli_fetch_row($resultado3);

$sql = "SELECT id_cargo FROM `usuarios` WHERE usuario = '$usuario';";
$result = mysqli_query($conexiondb, $sql);

$usuario = $_SESSION['usuario'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
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
            </div>
        </div>

        <div class="dash-content">
            <form action="../../Backend/caja/cerrar.php" class="formRecepcion" method="POST">
                <h1 align="center">Cerrar Caja</h1>
                <div class="row">
                    <div class="col-25">
                        <label for="lname">Ingresos</label>
                    </div>      
                    <div class="col-75">
                        <input type="number" id="lname" name="ingreso" placeholder="" required  value='<?php echo $caja[1]; ?>' readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="lname">Egresos</label>
                    </div>      
                    <div class="col-75">
                        <input type="number" id="lname" name="egreso" placeholder="" required  value='<?php echo $caja[2]; ?>' readonly>
                    </div>
                </div>
                <br>
                <div class="row">
                    <input type="hidden" name="id_caja" id="" value='<?php echo $caja[0]; ?>' readonly>
                    <input type="hidden" name="editar" id="" value='no' readonly>
                    <input type="submit" value="Guardar">
                </div>
            </form>
        </div>
    </section>
</body>
</html>