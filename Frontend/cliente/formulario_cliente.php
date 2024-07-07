<?php require "../../include/header.php" ?>
<?php require "../../backend/config/baseDeDatos.php"?>
<?php


$usuario = $_SESSION['usuario'];
if (!isset($usuario)) {
    header("location:../../index.php");
}
$conexiondb = conectardb();
$query = "SELECT * FROM departamentos ORDER BY id_departamento";
$resultado = mysqli_query($conexiondb, $query);

$query2 = "SELECT * FROM ciudades WHERE id_departamento = 'id_departamento'";
$resultado2 = mysqli_query($conexiondb, $query2);

$sql = "SELECT id_cargo FROM `usuarios` WHERE usuario = '$usuario';";
$result = mysqli_query($conexiondb, $sql);
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
    <section id="content">
        <main>
                <div class="left">
                    <nav class="nav">
                        <ul class="breadcrumb">
                            <li>
                            <a class="active" href="../reportes/reporte_cliente.php">Clientes</a>
                            </li>
                        </ul>
                        <ul class="breadcrumb">
                            <li>
                                <a class="active" href="./formulario_cliente.php">Registrar</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            <div class="table-data">
                <div class="container">
                    <form action="../../Backend/cliente/guardar_cliente.php" class="formRecepcion" method="POST">
                        <h1 align="center">Registrar Cliente</h1>
                        <div class="row">
                            <div class="col-25">
                                <label for="fname">Numero de Cedula</label>
                            </div>
                            <div class="col-75">
                                <input type="text" id="fname" name="cedula" placeholder="" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-25">
                                <label for="lname">Nombres y Apellidos</label>
                            </div>
                            <div class="col-75">
                                <input type="text" id="lname" name="nombre" placeholder="" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-25">
                                <label for="lname">RUC</label>
                            </div>
                            <div class="col-75">
                                <input type="text" id="lname" name="ruc" placeholder="" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-25">
                                <label for="country">Departamento</label>
                            </div>
                            <div class="col-75">
                                <select id="departamento" name="id_departamento" onchange="getCiudades(this.value)" required>
                                    <option value="">Seleccione una opción</option>
                                    <?php
                                    while ($departamento = mysqli_fetch_assoc($resultado)) {
                                        echo "<option value='" . $departamento['id_departamento'] . "'>" . $departamento['nombre'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-25">
                                <label for="country">Ciudad</label>
                            </div>
                            <div class="col-75">
                                <select id="ciudad" name="id_ciudad" required>
                                    <option value="">Seleccione una opción</option> <!-- Opción en blanco -->
                                    <?php
                                    while ($ciudad = mysqli_fetch_assoc($resultado2)) {
                                        echo "<option value='" . $ciudad['id_ciudad'] . "'>" . $ciudad['nombre'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <input type="hidden" name="id_usuario" id="" value='<?php echo $idUsuario[0]; ?>' readonly>
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