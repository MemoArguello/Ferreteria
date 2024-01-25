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

$usuario = $_SESSION['usuario'];

$id_factura = $_GET['id_factura'];
$query = "SELECT facturas.id_factura, facturas.codigo_factura, cliente.nombre, facturas.tipo, facturas.fecha_creacion,
         cliente.id_cliente FROM facturas JOIN cliente ON cliente.id_cliente =  facturas.cliente WHERE id_factura =" . $id_factura;
$resultado3 = mysqli_query($conexiondb, $query);

$venta = mysqli_fetch_row($resultado3);
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
                <a href="./venta.php" <?php if (basename($_SERVER['PHP_SELF']) == 'venta.php') echo 'class="active"'; ?>>Venta</a>
                <a href="../reportes/reporte_venta.php" <?php if (basename($_SERVER['PHP_SELF']) == 'registrar_productos.php') echo 'class="active"'; ?>>Registros Venta</a> 
                <a href="../reportes/reporte_factura.php" <?php if (basename($_SERVER['PHP_SELF']) == 'reporte_factura.php') echo 'class="active"'; ?>>Facturas</a>
            </div>
        </div>

        <div class="dash-content">
            <form action="../../Backend/venta/guardar_venta.php" class="formRecepcion" method="POST">
                <h1 align="center">Editar Venta</h1>
                <div class="row">
                    <div class="col-25">
                        <label for="fname">Codigo de Factura</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="fname" name="codigo_factura" placeholder="" required value='<?php echo $venta[1]; ?>' readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="lname">Cliente</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="lname" name="cliente" placeholder="" required value='<?php echo $venta[2]; ?>' readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="lname">Tipo de Servicio</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="tipo" name="tipo" placeholder="" required value='<?php echo $venta[3]; ?>' readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="lname">Fecha</label>
                    </div>
                    <div class="col-75">
                        <input type="date" id="date" name="fecha_creacion" placeholder="" required value='<?php echo $venta[4]; ?>'>
                    </div>
                </div>
                <br>
                <div class="row">
                    <input type="hidden" name="id_factura" id="" value='<?php echo $venta[0]; ?>' readonly>
                    <input type="hidden" name="editar" id="" value='si' readonly>
                    <input type="submit" value="Guardar">
                </div>
            </form>
        </div>
    </section>
</body>

</html>