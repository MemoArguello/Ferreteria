<?php
session_start();
include '../../Backend/config/baseDeDatos.php';

$usuario = $_SESSION['usuario'];
if (!isset($usuario)) {
    header("location:../../index.php");
}
$conexiondb = conectardb();
$query3 = "SELECT * FROM departamentos ORDER BY id_departamento";
$resultado = mysqli_query($conexiondb, $query3);

$query2 = "SELECT * FROM ciudades WHERE id_departamento = 'id_departamento'";
$resultado2 = mysqli_query($conexiondb, $query2);

$sql = "SELECT id_cargo FROM `usuarios` WHERE usuario = '$usuario';";
$result = mysqli_query($conexiondb, $sql);
while ($usuario = mysqli_fetch_assoc($result)) {
    if ($usuario['id_cargo'] != 1) {
        header("location:../../index.php");
    }
}
$usuario = $_SESSION['usuario'];

$id_proveedor = $_GET['id_proveedor'];
$query = "SELECT proveedores.id_proveedor, proveedores.nombre_prov, proveedores.ruc, proveedores.telefono, departamentos.nombre as nombre_departamento, ciudades.nombre as nombre_ciudad FROM proveedores JOIN departamentos 
            ON departamentos.id_departamento = proveedores.departamento  JOIN ciudades ON ciudades.id_ciudad = proveedores.distrito where id_proveedor=" . $id_proveedor;
$resultado3 = mysqli_query($conexiondb, $query);

$proveedor = mysqli_fetch_row($resultado3);
mysqli_close($conexiondb);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proveedores</title>
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
                <a href="../reportes/reporte_prov.php" <?php if (basename($_SERVER['PHP_SELF']) == '../reportes/reporte_cliente.php') echo 'class="active"'; ?>>Proveedores</a>
                <a href="./agg_proveedor.php" <?php if (basename($_SERVER['PHP_SELF']) == 'agg_proveedor.php') echo 'class="active"'; ?>>Registrar</a>
            </div>
        </div>

        <div class="dash-content">
            <form action="../../Backend/proveedor/guardar_prov.php" class="formRecepcion" method="POST">
                <h1 align="center">Editar Proveedor</h1>
                <div class="row">
                    <div class="col-25">
                        <label for="fname">Nombre Proveedor</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="fname" name="nombre_prov" placeholder="" required value='<?php echo $proveedor[1]; ?>'>
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="lname">RUC</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="lname" name="ruc" placeholder="" required value='<?php echo $proveedor[2]; ?>'>
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="lname">Telefono</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="lname" name="telefono" placeholder="" required value='<?php echo $proveedor[3]; ?>'>
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="lname">Departamento</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="lname" name="departamento" placeholder="" required value='<?php echo $proveedor[4]; ?>' readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="lname">Ciudad</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="lname" name="ciudad" placeholder="" required value='<?php echo $proveedor[5]; ?>' readonly>
                    </div>
                </div>

                <br>
                <div class="row">
                    <input type="hidden" name="id_proveedor" id="" value='<?php echo $proveedor[0]; ?>' readonly>
                    <input type="hidden" name="editar" id="" value='si' readonly>
                    <input type="submit" value="Guardar">
                </div>
            </form>
        </div>
    </section>
</body>

</html>