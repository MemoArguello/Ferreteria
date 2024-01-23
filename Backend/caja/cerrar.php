<?php
include '../../Backend/config/baseDeDatos.php';

$id_caja = $_GET['id_caja'];
$estado = 'Cerrado';

$fechaActual = date("Y-m-d H:i:s");

$conexiondb = conectardb();

$query ="UPDATE caja SET estado='" . $estado . "', fecha_cierre='" . $fechaActual . "' WHERE id_caja=".$id_caja;

$respuesta= mysqli_query($conexiondb, $query);

if ($respuesta) {
    header("Location: ../../Frontend/reportes/reporte_caja.php");
    exit();
} else {
    header("Location: ../../Frontend/reportes/reporte_caja.php");
    exit();
}


?>