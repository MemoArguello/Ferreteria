<?php
include '../../Backend/config/baseDeDatos.php';

$id_producto = isset($_GET['id_producto']) ? mysqli_real_escape_string(conectardb(), $_GET['id_producto']) : '';

if (empty($id_producto)) {
    echo "<script>alert('ID de producto no válido');
    window.location.href='../../Frontend/reportes/reporte_prod.php'</script>";
    exit();
}

$conexiondb = conectardb();


// Intenta eliminar el producto
try{$query_delete_producto = $conexiondb->prepare("DELETE * FROM productos WHERE id_producto=?");
$query_delete_producto->bind_param("i", $id_producto);
$query_delete_producto->execute();
}catch (Exception){
    echo "<script>alert('No se pudo eliminar el producto');
    window.location.href='../../Frontend/reportes/reporte_prod.php'</script>";
    exit();
}
if ($query_delete_producto->affected_rows > 0) {
    header("Location: ../../Frontend/reportes/reporte_prod.php");
    exit();
} else {
    echo "<script>alert('No se pudo eliminar el producto');
    window.location.href='../../Frontend/reportes/reporte_prod.php'</script>";
    exit();
}

$query_delete_producto->close();
mysqli_close($conexiondb);
?>
