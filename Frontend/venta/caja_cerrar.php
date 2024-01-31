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
$query3 = "SELECT caja.id_caja,  caja.ingreso, caja.egreso FROM caja where id_caja = $id_caja";
$resultado3 = mysqli_query($conexiondb, $query3);
$caja = mysqli_fetch_row($resultado3);

$sql = "SELECT id_cargo FROM `usuarios` WHERE usuario = '$usuario';";
$result = mysqli_query($conexiondb, $sql);

$usuario = $_SESSION['usuario'];
$usuario = $_SESSION['usuario'];
$queryUsuario = "SELECT id_usuario FROM usuarios WHERE usuario = '$usuario'";
$resultadoUsuario = mysqli_query($conexiondb, $queryUsuario);

// Verificar si se obtuvo el resultado
if ($resultadoUsuario) {
    // Obtener el ID del usuario
    $usuarioInfo = mysqli_fetch_assoc($resultadoUsuario);
    $idUsuario = $usuarioInfo['id_usuario'];
} else {
    // Manejar el error si la consulta no fue exitosa
    echo "Error al obtener el ID del usuario.";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Caja</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../IMG/nut_5361285.png" rel="icon">
</head>

<body>
    <?php
    include($_SERVER['DOCUMENT_ROOT'] . '/Sistema_Ferreteria/Frontend/dashboard/inicio.php');
    ?>
    <section id="content">
        <main>
                <div class="left">
                    <nav class="nav">
                        <ul class="breadcrumb">
                            <li>
                                <a class="active" href="../reportes/reporte_caja.php">Cajas</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            <div class="table-data">
                <div class="container">
                    <form action="../../Backend/caja/cerrar.php" class="form_venta" method="POST">
                        <h1 align="center">Cerrar Caja</h1>
                        <div class="row">
                            <div class="col-25">
                                <label for="lname">Ingresos</label>
                            </div>
                            <div class="col-75">
                                <input type="number" id="lname" name="ingreso" placeholder="" required value='<?php echo $caja[1]; ?>' readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-25">
                                <label for="lname">Egresos</label>
                            </div>
                            <div class="col-75">
                                <input type="number" id="lname" name="egreso" placeholder="" required value='<?php echo $caja[2]; ?>' readonly>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <input type="hidden" name="id_usuario" id="" value='<?php echo $idUsuario[0]; ?>' readonly>
                            <input type="hidden" name="id_caja" id="" value='<?php echo $caja[0]; ?>' readonly>
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