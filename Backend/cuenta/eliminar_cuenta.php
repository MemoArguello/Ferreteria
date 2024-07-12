<?php
include '../../Backend/config/baseDeDatos.php';

if (isset($_POST['id'])) {
    $id_usuario = $_POST['id'];
    $estado = 0;

    try {
        $query = $conn->prepare("UPDATE usuarios SET estado = :estado WHERE id_usuario = :id_usuario");
        $query->bindParam(':estado', $estado);
        $query->bindParam(':id_usuario', $id_usuario);

        if ($query->execute()) {
            header('Location: ../../Frontend/reportes/reporte_cuenta.php?status=success');
        } else {
            header('Location: ../../Frontend/reportes/reporte_cuenta.php?status=error');
        }
    } catch (PDOException $e) {
        error_log($e->getMessage(), 3, '../../Backend/logs/error.log');
        header('Location: ../../Frontend/reportes/reporte_cuenta.php?status=error');
    }
} else {
    header('Location: ../../Frontend/reportes/reporte_cuenta.php?status=invalid');
}
?>
