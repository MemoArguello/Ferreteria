<?php
include '../../Backend/config/baseDeDatos.php';

if (isset($_POST['id'])) {
    $id_usuario = $_POST['id'];

    try {
        $query = $conn->prepare("UPDATE usuarios SET estado = 0 WHERE id_usuario = :id_usuario");
        $query->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);

        if ($query->execute()) {
            header('Location: ../../Frontend/reportes/reporte_cuenta.php');
        } else {
            header('Location: ../../Frontend/reportes/reporte_cuenta.php');
        }
    } catch (PDOException $e) {
        header('Location: ../../Frontend/reportes/reporte_cuenta.php');
    }
} else {
    header('Location: ../../Frontend/reportes/reporte_cuenta.php');}
?>
