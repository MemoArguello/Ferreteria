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
while ($usuario = mysqli_fetch_assoc($result)) {
    if ($usuario['id_cargo'] != 1) {
        header("location:../../index.php");
    }
}
$usuario = $_SESSION['usuario'];
$conexiondb = conectardb();
$query = "SELECT * FROM cargo ORDER BY id ASC";
$resultado = mysqli_query($conexiondb, $query);
mysqli_close($conexiondb);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuracion</title>
    <!----======== CSS ======== -->
    <link rel="stylesheet" href="./../CSS/style.css">
    <link rel="stylesheet" href="../CSS/registrar.css">

    <!----===== Iconscout CSS ===== -->
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
                <a href="../reportes/reporte_cuenta.php" <?php if (basename($_SERVER['PHP_SELF']) == '../reportes/reporte_cuenta.php') echo 'class="active"'; ?>>Cuentas</a>
                <a href="./registrar_usuario.php" <?php if (basename($_SERVER['PHP_SELF']) == 'registrar_usuario.php') echo 'class="active"'; ?>>Registrar Cuenta</a>
            </div>
        </div>

        <div class="dash-content">
            <form action="../../Backend/cuenta/guardar_cuenta.php" class="formRecepcion" method="POST">
            <h1 align="center">Registrar Usuario</h1>
                <div class="row">
                    <div class="col-25">
                        <label for="fname">Correo Electronico</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="fname" name="correo" placeholder="Your name..">
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="lname">Nombre de Usuario</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="lname" name="usuario" placeholder="Your last name..">
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="lname">Contraseña</label>
                    </div>
                    <div class="col-75">
                        <input type="password" id="lname" name="codigo" placeholder="Your last name..">
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="lname">Confirmar Contraseña</label>
                    </div>
                    <div class="col-75">
                        <input type="password" id="lname" name="ccodigo" placeholder="Your last name..">
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="country">Cargo</label>
                    </div>
                    <div class="col-75">
                        <select id="country" name="id_cargo">
                        <option value="">Seleccione una opción</option> <!-- Opción en blanco -->
                        <?php
                            while ($cargo = mysqli_fetch_assoc($resultado)) {
                                echo "<option value='" . $cargo['id'] . "'>" . $cargo['descripcion'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <br>
                <div class="row">
                    <input type="submit" value="Guardar">
                </div>
            </form>
        </div>

        </div>
    </section>

    <script src="../JS/script.js"></script>

</body>

</html>