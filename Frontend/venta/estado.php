<?php
include '../../Backend/config/baseDeDatos.php';

$id_detalle = $_GET['id_detalle'];
$pagado = 'Pagado';

$conexiondb = conectardb();

$query ="UPDATE detalle_factura SET estado='" . $pagado . "' WHERE id_detalle=".$id_detalle;

$respuesta= mysqli_query($conexiondb, $query);

if ($respuesta) {
    header("Location: ../reportes/reporte_factura.php");
    exit();
} else {
    header("Location: ../reportes/reporte_factura.php");
    exit();
}


?>
