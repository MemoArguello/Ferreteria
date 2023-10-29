<?php
session_start();
include '../../Backend/config/baseDeDatos.php';

$usuario = $_SESSION['usuario'];
if (!isset($usuario)) {
    header("location:../../index.php");
}
$conexiondb = conectardb();
    $sql = "SELECT id_cargo FROM `usuarios` WHERE usuario = '$usuario';";
    $result = mysqli_query($conexiondb, $sql);
    while ($usuario= mysqli_fetch_assoc($result)) {
        if ($usuario['id_cargo'] != 1) {
            header("location:../../index.php");
        }
}
$usuario = $_SESSION['usuario'];
$conexiondb = conectardb();
$id_usuario = $_GET['id_usuario'];
$query_c = "SELECT * FROM cargo";
$resultado_c = mysqli_query($conexiondb, $query_c);
$cargos = mysqli_fetch_row($resultado_c);

$query = "SELECT * FROM usuarios WHERE id_usuario=" . $id_usuario;
$resultado = mysqli_query($conexiondb, $query);
$usuarios = mysqli_fetch_row($resultado);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!----======== CSS ======== -->
    <link rel="stylesheet" href="./../CSS/style.css">
    <link rel="stylesheet" href="../CSS/registrar.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link href="./IMG/logo.svg" rel="icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <?php
    include($_SERVER['DOCUMENT_ROOT'] . '/Sistema_Ferreteria/Frontend/dashboard/inicio.php');
    ?>
    <section class="dashboard">
        <div class="top">
            <div class="topnav" id="myTopnav">
                <a href="../reportes/reporte_cuenta.php">Cuentas Existentes</a>
                <a href="./registrar_usuario.php">Registrar Cuenta</a>
            </div>
        </div>

        <div class="dash-content">
            <form action="../../Backend/cuenta/cambiar_contraseña.php" class="formRecepcion" method="POST">
            <h1 align="center">Cambiar Contraseña</h1>
                <div class="row">
                    <div class="col-25">
                        <label for="lname">Nombre de Usuario</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="lname" name="usuario"  value='<?php echo $usuarios[2] ?>' readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="lname">Contraseña Nueva</label>
                    </div>
                    <div class="col-75">
                        <input type="password" id="lname" name="codigo" minlength="5">
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="lname">Confirmar Contraseña Nueva</label>
                    </div>
                    <div class="col-75">
                        <input type="password" id="lname" name="ccodigo" minlength="5">
                    </div>
                </div>
                <br>
                <div class="row">
                     <input type="hidden" name="id_usuario" id="" value='<?php echo $usuarios[0] ?>' readonly>
                     <input type="hidden" name="editar" id="" value='si' readonly>
                     <input type="submit" value="Guardar">
                </div>
            </form>
        </div>

        </div>
    </section>

    <script src="../JS/script.js"></script>    
</body>
</html>