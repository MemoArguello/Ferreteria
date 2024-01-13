<?php
include '../../Backend/config/baseDeDatos.php';

$id_producto = isset($_GET['id_producto']) ? mysqli_real_escape_string(conectardb(), $_GET['id_producto']) : '';

if (empty($id_producto)) {
    echo "<script>alert('ID de proveedor no válido');
    window.location.href='../../Frontend/reportes/reporte_prov.php'</script>";
    exit();
}

$conexiondb = conectardb();

$query = $conexiondb->prepare("DELETE FROM productos WHERE id_producto=?");
$query->bind_param("i", $id_producto);
$query->execute();

if ($query->affected_rows > 0) {
    header("Location: ../../Frontend/reportes/reporte_prod.php");
    exit();
} else {
    header("Location: ../../Frontend/reportes/reporte_prod.php");
    exit();
}

$query->close();
mysqli_close($conexiondb);
?>
