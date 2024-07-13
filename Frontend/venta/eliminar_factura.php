<?php
include '../../Backend/config/baseDeDatos.php';

if (isset($_POST['id_factura'])) {
    $id_factura = $_POST['id_factura'];
    $estado = 0;

    try {
        $query = $conn->prepare("UPDATE factura_cabecera SET estado = :estado WHERE id_factura = :id_factura");
        $query->bindParam(':estado', $estado);
        $query->bindParam(':id_factura', $id_factura);

        if ($query->execute()) {
            header('Location: ../../Frontend/venta/venta.php?status=success');
        } else {
            header('Location: ../../Frontend/venta/venta.php?status=error');
        }
    } catch (PDOException $e) {
        error_log($e->getMessage(), 3, '../../Backend/logs/error.log');
        header('Location: ../../Frontend/venta/venta.php?status=error');
    }
} else {
    header('Location: ../../Frontend/venta/venta.php?status=invalid');
}
?>
