<?php
include '../config/baseDeDatos.php';

$id_factura = isset($_GET['id_factura']) ? mysqli_real_escape_string(conectardb(), $_GET['id_factura']) : '';

if (empty($id_factura)) {
    echo "<script>alert('ID de venta no válido');
    window.location.href='../../Frontend/reportes/reporte_venta.php'</script>";
    exit();
}

$conexiondb = conectardb();

$query = $conexiondb->prepare("DELETE FROM facturas WHERE id_factura=?");
$query->bind_param("i", $id_factura);
$query->execute();

if ($query->affected_rows > 0) {
    echo "<script>alert('Registro Eliminado');
    window.location.href='../../Frontend/reportes/reporte_venta.php'</script>";
    exit();
} else {
    echo "<script>alert('No se pudo Eliminar');
    window.location.href='../../Frontend/reportes/reporte_venta.php'</script>";
}

$query->close();
mysqli_close($conexiondb);
?>
