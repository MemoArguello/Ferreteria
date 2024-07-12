<?php
include '../config/baseDeDatos.php';

if (isset($_POST['id'])) {
    $id_factura = $_POST['id'];

    try {
        $query = $conn->prepare("DELETE FROM factura_cabecera WHERE id_factura = :id_factura");
        $query->bindParam(':id_factura', $id_factura, PDO::PARAM_INT);

        if ($query->execute()) {
            echo "<script>alert('detalle_factura Eliminado'); window.location.href='../../Frontend/reportes/reporte_factura.php';</script>";
        } else {
            echo "<script>alert('No se pudo eliminar la factura'); window.location.href='../../Frontend/reportes/reporte_factura.php';</script>";
        }
    } catch (Exception $e) {
        echo "<script>alert('Error: No se pudo eliminar la factura porque esta relacionada'); window.location.href='../../Frontend/reportes/reporte_factura.php';</script>";
    }
} else {
    echo "<script>alert('Error: ID detalle_factura no recibido'); window.location.href='../../Frontend/reportes/reporte_factura.php';</script>";
}
?>
