<?php
include '../../Backend/config/baseDeDatos.php';

if (isset($_POST['id'])) {
    $id_producto = $_POST['id'];
    $estado = 0;

    try {
        $query = $conn->prepare("UPDATE productos SET estado = :estado WHERE id_producto = :id_producto");
        $query->bindParam(':estado', $estado);
        $query->bindParam(':id_producto', $id_producto);

        if ($query->execute()) {
            header('Location: ../../Frontend/reportes/reporte_prod.php?status=success');
        } else {
            header('Location: ../../Frontend/reportes/reporte_prod.php?status=error');
        }
    } catch (PDOException $e) {
        error_log($e->getMessage(), 3, '../../Backend/logs/error.log');
        header('Location: ../../Frontend/reportes/reporte_prod.php?status=error');
    }
} else {
    header('Location: ../../Frontend/reportes/reporte_prod.php?status=invalid');
}
?>