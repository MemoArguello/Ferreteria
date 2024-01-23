<?php
include '../../Backend/config/baseDeDatos.php';

$id_detalle = isset($_GET['id_detalle']) ? mysqli_real_escape_string(conectardb(), $_GET['id_detalle']) : '';

if (empty($id_detalle)) {
    echo "<script>alert('ID de venta no válido');
    window.location.href='../reportes/reporte_factura.php'</script>";
    exit();
}

$conexiondb = conectardb();

$query = $conexiondb->prepare("DELETE FROM detalle_factura WHERE id_detalle=?");
$query->bind_param("i", $id_detalle);
$query->execute();

if ($query->affected_rows > 0) {
    echo "<script>alert('Registro Eliminado');
    window.location.href='../reportes/reporte_factura.php'</script>";
    exit();
} else {
    echo "<script>alert('No se pudo Eliminar');
    window.location.href='../reportes/reporte_factura.php'</script>";
}

$query->close();
mysqli_close($conexiondb);
?>
