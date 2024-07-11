<?php
include '../config/baseDeDatos.php';

if (isset($_POST['id'])) {
    $id_proveedor = $_POST['id'];

    try {
        $query = $conn->prepare("DELETE FROM proveedores WHERE id_proveedor = :id_proveedor");
        $query->bindParam(':id_proveedor', $id_proveedor, PDO::PARAM_INT);

        if ($query->execute()) {
            echo "<script>alert('Proveedor Eliminado'); window.location.href='../../Frontend/reportes/reporte_prov.php';</script>";
        } else {
            echo "<script>alert('No se pudo eliminar el proveedor'); window.location.href='../../Frontend/reportes/reporte_prov.php';</script>";
        }
    } catch (Exception $e) {
        echo "<script>alert('Error: No se pudo eliminar el proveedor porque esta relacionada'); window.location.href='../../Frontend/reportes/reporte_prov.php';</script>";
    }
} else {
    echo "<script>alert('Error: ID de proveedor no recibido'); window.location.href='../../Frontend/reportes/reporte_prov.php';</script>";
}
?>

