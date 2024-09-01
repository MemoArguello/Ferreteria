<?php
require "../../include/header.php";
include '../../Backend/config/baseDeDatos.php';

$usuario = $_SESSION['usuario'];
if (!isset($usuario)) {
    header("location:../../index.php");
}

$id_usuario = $_GET['id'];
$query2 = $conn->query("SELECT * FROM usuarios WHERE id_usuario = '$id_usuario'");
$query2->execute();

$resultado2 = $query2->fetch(PDO::FETCH_OBJ);


?>

<body>
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
                    <ul class="breadcrumb">
                        <li>
                            <a class="active" href="../configuracion/informacion.php">Datos de la Empresa</a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="table-data">
                <div class="container">
                    <form action="../../Backend/cuenta/cambiar_contraseña.php" class="form_vent" method="POST">
                        <h1 align="center">Cambiar Contraseña</h1>
                        <div class="row">
                            <div class="col-25">
                                <label for="lname">Nombre de Usuario</label>
                            </div>
                            <div class="col-75">
                                <input type="text" id="lname" name="usuario" value='<?php echo $resultado2->usuario ?>' readonly>
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
                        <br>
                        <div class="row">
                            <input type="hidden" name="id_usuario" id="" value='<?php echo $resultado2->id_usuario ?>' readonly>
                            <input type="hidden" name="editar" id="" value='si' readonly>
                            <input type="submit" class="boton2" value="Editar">
                        </div>
                    </form>
                </div>
            </div>
    </section>
    <?php require "../../include/footer.php"; ?>