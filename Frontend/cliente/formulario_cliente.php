<?php
session_start();
include '../../Backend/config/baseDeDatos.php';

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
    <script>
        function getCiudades(departamentoId) {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("ciudad").innerHTML = this.responseText;
                }
            };
            xhttp.open("GET", "get_ciudades.php?departamento_id=" + departamentoId, true);
            xhttp.send();
        }
    </script>

</head>

<body>
    <?php
    include($_SERVER['DOCUMENT_ROOT'] . '/Sistema_Ferreteria/Frontend/dashboard/inicio.php');
    ?>
    <section class="dashboard">
        <div class="top">
            <div class="topnav" id="myTopnav">
                <a href="../reportes/reporte_cliente.php" <?php if (basename($_SERVER['PHP_SELF']) == '../reportes/reporte_cliente.php') echo 'class="active"'; ?>>Clientes</a>
                <a href="./formulario_cliente.php" <?php if (basename($_SERVER['PHP_SELF']) == 'formulario_cliente.php') echo 'class="active"'; ?>>Registrar</a>
            </div>
        </div>

        <div class="dash-content">
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
                        <label for="lname">Nombres</label>
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
                    <input type="hidden" name="editar" id="" value='no' readonly>
                    <input type="submit" value="Guardar">
                </div>
            </form>
        </div>
    </section>
</body>

</html>