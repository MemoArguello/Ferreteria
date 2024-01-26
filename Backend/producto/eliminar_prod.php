<?php
include '../../Backend/config/baseDeDatos.php';

$id_producto = $_GET['id_producto'];
$conexiondb = conectardb();

try {
    $query = "DELETE FROM productos WHERE id_producto=" . $id_producto;
    $respuesta = mysqli_query($conexiondb, $query);

    if ($respuesta) {
        echo "<script>alert('Producto Eliminado'); window.location.href='../../Frontend/reportes/reporte_prod.php'</script>";
    } else {
        echo "<script>alert('No se pudo Eliminar'); window.location.href='../../Frontend/reportes/reporte_prod.php'</script>";
    }
} catch (Exception $e) {
    // Si ocurre una excepción, mostrar un mensaje de error
    echo "<script>alert('No se pudo Eliminar'); window.location.href='../../Frontend/reportes/reporte_prod.php'</script>";
} finally {
    // Cerrar la conexión
    mysqli_close($conexiondb);
}
?>