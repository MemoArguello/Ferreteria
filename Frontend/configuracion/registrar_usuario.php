<?php require "../../include/header.php" ?>
<?php require "../../backend/config/baseDeDatos.php" ?>
<?php

$usuario = $_SESSION['usuario'];
if (!isset($usuario)) {
    header("location:../../index.php");
}
$sql = $conn->query("SELECT id_cargo FROM `usuarios` WHERE usuario = '$usuario'");
$sql->execute();
$resultado = $sql->fetchAll(PDO::FETCH_ASSOC);


$query = $conn->query("SELECT * FROM cargo ORDER BY id ASC");
$query->execute();
$resultado = $query->fetchAll(PDO::FETCH_ASSOC);
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
                <ul class="breadcrumb">
                    <li>
                        <a class="active" href="../configuracion/informacion.php">Datos de la Empresa</a>
                    </li>
                </ul>
            </nav>
        </div>
        </div>
        <div class="table-data">
            <div class="container">
                <form action="../../Backend/cuenta/guardar_cuenta.php" class="formRecepcion" method="POST">
                    <h1 align="center">Registrar Usuario</h1>
                    <div class="row">
                        <div class="col-25">
                            <label for="fname">Correo Electronico</label>
                        </div>
                        <div class="col-75">
                            <input type="text" id="fname" name="correo" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="lname">Nombre de Usuario</label>
                        </div>
                        <div class="col-75">
                            <input type="text" id="lname" name="usuario" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="lname">Contraseña</label>
                        </div>
                        <div class="col-75">
                            <input type="password" id="lname" name="codigo" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="lname">Confirmar Contraseña</label>
                        </div>
                        <div class="col-75">
                            <input type="password" id="lname" name="ccodigo" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="country">Cargo</label>
                        </div>
                        <div class="col-75">
                            <select id="country" name="id_cargo" required>
                                <option value="">Seleccione una opción</option> <!-- Opción en blanco -->
                                <?php
                                foreach ($resultado as $cargo) {
                                    echo "<option value='" . $cargo['id'] . "'>" . $cargo['descripcion'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <input type="submit" value="Guardar" class="boton2">
                    </div>
                </form>
            </div>

        </div>
    </main>
</section>
<?php require "../../include/footer.php" ?>