<?php
include '../../Backend/config/baseDeDatos.php';

$id_caja = isset($_GET['id_caja']) ? mysqli_real_escape_string(conectardb(), $_GET['id_caja']) : '';

if (empty($id_caja)) {
    echo "<script>alert('ID de venta no válido');
    window.location.href='../reportes/reporte_factura.php'</script>";
    exit();
}

$conexiondb = conectardb();

$query = $conexiondb->prepare("DELETE FROM caja WHERE id_caja=?");
$query->bind_param("i", $id_caja);
$query->execute();

if ($query->affected_rows > 0) {
    echo "<script>alert('Registro Eliminado');
    window.location.href='../reportes/reporte_caja.php'</script>";
    exit();
} else {
    echo "<script>alert('No se pudo Eliminar');
    window.location.href='../reportes/reporte_caja.php'</script>";
}

$query->close();
mysqli_close($conexiondb);
?>
