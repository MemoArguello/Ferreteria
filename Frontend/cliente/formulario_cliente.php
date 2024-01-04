<?php
session_start();
include '../../Backend/config/baseDeDatos.php';

$usuario = $_SESSION['usuario'];
if (!isset($usuario)) {
    header("location:../../index.php");
}
$conexiondb = conectardb();
$sql2 = "SELECT id_ciudad FROM `ciudades`";
$sql = "SELECT id_cargo FROM `usuarios` WHERE usuario = '$usuario';";
$result = mysqli_query($conexiondb, $sql);
while ($usuario = mysqli_fetch_assoc($result)) {
    if ($usuario['id_cargo'] != 1) {
        header("location:../../index.php");
    }
}
$usuario = $_SESSION['usuario'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes</title>
    <link rel="stylesheet" href="../CSS/style.css">
    <link rel="stylesheet" href="../CSS/stiles.css">
    <link rel="stylesheet" href="../CSS/registrar.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
</head>

<body>
    <?php
    include($_SERVER['DOCUMENT_ROOT'] . '/Sistema_Ferreteria/Frontend/dashboard/inicio.php');
    ?>
    <section class="dashboard">
        <div class="top">
            <div class="topnav" id="myTopnav">
                <a href="#" <?php if (basename($_SERVER['PHP_SELF']) == 'index.php') echo 'class="active"'; ?>>Clientes</a>
                <a href="./formulario_cliente.php" <?php if (basename($_SERVER['PHP_SELF']) == 'formulario_cliente.php') echo 'class="active"'; ?>>Registrar</a>
            </div>
        </div>

        <div class="dash-content">
            <form action="../../Backend/cuenta/guardar_cuenta.php" class="formRecepcion" method="POST">
                <h1 align="center">Registrar Cliente</h1>
                <div class="row">
                    <div class="col-25">
                        <label for="fname">Numero de Cedula</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="fname" name="correo" placeholder="Your name..">
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="lname">Nombres</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="lname" name="usuario" placeholder="Your last name..">
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="lname">RUC</label>
                    </div>
                    <div class="col-75">
                        <input type="password" id="lname" name="codigo" placeholder="Your last name..">
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="lname">Numero de Contacto</label>
                    </div>
                    <div class="col-75">
                        <input type="password" id="lname" name="ccodigo" placeholder="Your last name..">
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="country">Ciudad</label>
                    </div>
                    <div class="col-75">
                        <select id="country" name="id">
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
    </section>
</body>

</html>