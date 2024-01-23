<?php
include ('../config/baseDeDatos.php');

$fechaActual = date("Y-m-d H:i:s");


$conexiondb = conectardb();

$query = "INSERT INTO caja (fecha_apertura, estado) VALUES
        ('$fechaActual', 'Abierto')";

//$query2 = "INSERT INTO auditoria (id_usuario, evento, fecha) VALUES
//('$usuario','Apertura de caja',now())";

$respuesta = mysqli_query($conexiondb, $query);

//$respuesta2 = mysqli_query($conexiondb, $query2);


if ($respuesta) {
    header("Location: ../../Frontend/reportes/reporte_caja.php");
    exit();
} else {
    header("Location: ../../Frontend/reportes/reporte_caja.php");
    exit();
}
mysqli_close($conexiondb);


?>