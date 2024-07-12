<?php
include '../../Backend/config/baseDeDatos.php';

$id_producto = $_POST['id'];

try {
    $query = $conn->prepare("DELETE FROM productos WHERE id_producto = :id_producto");
    $query->bindParam(':id_producto', $id_producto, PDO::PARAM_INT);

    if ($query->execute()) {
        header('location: ../../Frontend/reportes/reporte_prod.php');
    } else {
        header('location: ../../Frontend/reportes/reporte_prod.php');
    }
} catch (Exception $e) {
    // Si ocurre una excepción, mostrar un mensaje de error
    header('location: ../../Frontend/reportes/reporte_prod.php');
} finally {
    // Cerrar la conexión
}
?>
