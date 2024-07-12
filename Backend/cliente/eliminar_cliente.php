<?php
include '../../Backend/config/baseDeDatos.php';

if (isset($_POST['id'])) {
    $id_cliente = $_POST['id'];
    $estado = 0;

    try {
        $query = $conn->prepare("UPDATE cliente SET estado = :estado WHERE id_cliente = :id_cliente");
        $query->bindParam(':estado', $estado);
        $query->bindParam(':id_cliente', $id_cliente);

        if ($query->execute()) {
            header('Location: ../../Frontend/reportes/reporte_cliente.php?status=success');
        } else {
            header('Location: ../../Frontend/reportes/reporte_cliente.php?status=error');
        }
    } catch (PDOException $e) {
        error_log($e->getMessage(), 3, '../../Backend/logs/error.log');
        header('Location: ../../Frontend/reportes/reporte_cliente.php?status=error');
    }
} else {
    header('Location: ../../Frontend/reportes/reporte_cliente.php?status=invalid');
}
?>
