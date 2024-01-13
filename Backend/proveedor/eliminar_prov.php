<?php
include '../../Backend/config/baseDeDatos.php';

$id_proveedor = isset($_GET['id_proveedor']) ? mysqli_real_escape_string(conectardb(), $_GET['id_proveedor']) : '';

if (empty($id_proveedor)) {
    echo "<script>alert('ID de proveedor no válido');
    window.location.href='../../Frontend/reportes/reporte_prov.php'</script>";
    exit();
}

$conexiondb = conectardb();

$query = $conexiondb->prepare("DELETE FROM proveedores WHERE id_proveedor=?");
$query->bind_param("i", $id_proveedor);
$query->execute();

if ($query->affected_rows > 0) {
    header("Location: ../../Frontend/reportes/reporte_prov.php");
    exit();
} else {
    echo "<script>alert('No se pudo Eliminar');
    window.location.href='../../Frontend/reportes/reporte_prov.php'</script>";
}

$query->close();
mysqli_close($conexiondb);
?>
