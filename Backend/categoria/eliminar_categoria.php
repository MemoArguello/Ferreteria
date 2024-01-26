<?php
include '../config/baseDeDatos.php';

$id_categoria = $_GET['id_categoria'];
$conexiondb = conectardb();

try {
    $query = "DELETE FROM categorias WHERE id_categoria=" . $id_categoria;
    $respuesta = mysqli_query($conexiondb, $query);

    if ($respuesta) {
        echo "<script>alert('Categoria Eliminada'); window.location.href='../../Frontend/reportes/reporte_cat.php'</script>";
    } else {
        echo "<script>alert('No se pudo Eliminar'); window.location.href='../../Frontend/reportes/reporte_cat.php'</script>";
    }
} catch (Exception $e) {
    // Si ocurre una excepción, mostrar un mensaje de error
    echo "<script>alert('No se pudo Eliminar'); window.location.href='../../Frontend/reportes/reporte_cat.php'</script>";
} finally {
    // Cerrar la conexión
    mysqli_close($conexiondb);
}
?>