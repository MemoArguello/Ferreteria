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

$id_cliente = $_GET['id_cliente'];
$query = "SELECT cliente.id_cliente, cliente.cedula, cliente.nombre, cliente.ruc, departamentos.nombre as nombre_departamento, ciudades.nombre as nombre_ciudad FROM cliente JOIN departamentos 
            ON departamentos.id_departamento = cliente.id_departamento  JOIN ciudades ON ciudades.id_ciudad = cliente.id_ciudad where id_cliente=" . $id_cliente;
$resultado3 = mysqli_query($conexiondb, $query);

$cliente = mysqli_fetch_row($resultado3);
mysqli_close($conexiondb);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes</title>
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
                                <input type="text" id="fname" name="cedula" placeholder="" required value='<?php echo $cliente[1]; ?>'>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-25">
                                <label for="lname">Nombres</label>
                            </div>
                            <div class="col-75">
                                <input type="text" id="lname" name="nombre" placeholder="" required value='<?php echo $cliente[2]; ?>'>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-25">
                                <label for="lname">RUC</label>
                            </div>
                            <div class="col-75">
                                <input type="text" id="lname" name="ruc" placeholder="" required value='<?php echo $cliente[3]; ?>'>
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
                            <input type="hidden" name="id_cliente" id="" value='<?php echo $cliente[0]; ?>' readonly>
                            <input type="hidden" name="editar" id="" value='si' readonly>
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