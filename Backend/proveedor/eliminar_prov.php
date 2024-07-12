<?php
include '../../Backend/config/baseDeDatos.php';

if (isset($_POST['id'])) {
    $id_proveedor = $_POST['id'];
    $estado = 0;

    try {
        $query = $conn->prepare("UPDATE proveedores SET estado = :estado WHERE id_proveedor = :id_proveedor");
        $query->bindParam(':estado', $estado);
        $query->bindParam(':id_proveedor', $id_proveedor);

        if ($query->execute()) {
            header('Location: ../../Frontend/reportes/reporte_prov.php?status=success');
        } else {
            header('Location: ../../Frontend/reportes/reporte_prov.php?status=error');
        }
    } catch (PDOException $e) {
        error_log($e->getMessage(), 3, '../../Backend/logs/error.log');
        header('Location: ../../Frontend/reportes/reporte_prov.php?status=error');
    }
} else {
    header('Location: ../../Frontend/reportes/reporte_prov.php?status=invalid');
}
?>