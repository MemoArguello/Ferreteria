<?php
include '../config/baseDeDatos.php';

if (isset($_POST['id'])) {
    $id_factura = $_POST['id'];

    try {
        $query = $conn->prepare("DELETE FROM factura_cabecera WHERE id_factura = :id_factura");
        $query->bindParam(':id_factura', $id_factura, PDO::PARAM_INT);

        if ($query->execute()) {
            header('location: ../../Frontend/reportes/reporte_factura.php');
        } else {
            header('location: ../../Frontend/reportes/reporte_factura.php');
        }
    } catch (Exception $e) {
        header('location: ../../Frontend/reportes/reporte_factura.php');
    }
} else {
    header('location: ../../Frontend/reportes/reporte_factura.php');
}
?>
