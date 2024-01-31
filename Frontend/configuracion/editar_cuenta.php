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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuracion</title>
    <!----======== CSS ======== -->
    <!----===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link href="./IMG/logo.svg" rel="icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
                                <a class="active" href="../reportes/reporte_cuenta.php">Cuentas</a>
                            </li>
                        </ul>
                        <ul class="breadcrumb">
                            <li>
                                <a class="active" href="./registrar_usuario.php">Registrar Cuenta</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            <div class="table-data">
                <div class="container">

                    <form action="../../Backend/cuenta/editar.php" class="formRecepcion" method="POST">
                        <h1 align="center">Registrar Usuario</h1>
                        <div class="row">
                            <div class="col-25">
                                <label for="fname">Correo Electronico</label>
                            </div>
                            <div class="col-75">
                                <input type="text" id="fname" name="correo" value='<?php echo $usuarios[1] ?>'>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-25">
                                <label for="lname">Nombre de Usuario</label>
                            </div>
                            <div class="col-75">
                                <input type="text" id="lname" name="usuario" value='<?php echo $usuarios[2] ?>'>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-25">
                                <label for="country">Cargo</label>
                            </div>
                            <div class="col-75">
                                <?php
                                $query_rol = mysqli_query($conexiondb, "select * FROM cargo");
                                $result_cargo = mysqli_num_rows($query_rol);
                                ?>
                                <select id="" name="id_cargo">
                                    <option value="">Seleccione una opción</option> <!-- Opción en blanco -->
                                    <?php
                                    if ($result_cargo > 0) {
                                        while ($cargo = mysqli_fetch_array($query_rol)) {
                                    ?>
                                            <option value="<?php echo $cargo['id'] ?>"><?php echo $cargo['descripcion'] ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <input type="hidden" name="id_usuario" id="" value='<?php echo $usuarios[0] ?>' readonly>
                            <input type="hidden" name="editar" id="" value='si' readonly>
                            <input type="submit" value="Guardar" class="boton2">
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </section>

    <?php
    mysqli_close($conexiondb);
    ?>
    <script src="../dashboard/script.js"></script>

</body>

</html>