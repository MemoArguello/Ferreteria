<?php
include '../config/baseDeDatos.php';

$id_proveedor = $_GET['id_proveedor'];
$conexiondb = conectardb();

try {
    $query = "DELETE FROM proveedores WHERE id_proveedor=" . $id_proveedor;
    $respuesta = mysqli_query($conexiondb, $query);

    if ($respuesta) {
        echo "<script>alert('Proveedor Eliminado'); window.location.href='../../Frontend/reportes/reporte_prov.php'</script>";
    } else {
        echo "<script>alert('No se pudo Eliminar'); window.location.href='../../Frontend/reportes/reporte_prov.php'</script>";
    }
} catch (Exception $e) {
    // Si ocurre una excepción, mostrar un mensaje de error
    echo "<script>alert('No se pudo Eliminar'); window.location.href='../../Frontend/reportes/reporte_prov.php'</script>";
} finally {
    // Cerrar la conexión
    mysqli_close($conexiondb);
}
?>
