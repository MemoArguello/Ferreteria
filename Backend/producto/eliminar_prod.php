<?php
include '../../Backend/config/baseDeDatos.php';

$id_producto = $_POST['id'];

try {
    $query = $conn->prepare("DELETE FROM productos WHERE id_producto = :id_producto");
    $query->bindParam(':id_producto', $id_producto, PDO::PARAM_INT);

    if ($query->execute()) {
        echo "<script>alert('Producto Eliminado'); window.location.href='../../Frontend/reportes/reporte_prod.php'</script>";
    } else {
        echo "<script>alert('No se pudo Eliminar'); window.location.href='../../Frontend/reportes/reporte_prod.php'</script>";
    }
} catch (Exception $e) {
    // Si ocurre una excepción, mostrar un mensaje de error
    echo "<script>alert('No se pudo Eliminar'); window.location.href='../../Frontend/reportes/reporte_prod.php'</script>";
} finally {
    // Cerrar la conexión
}
?>
