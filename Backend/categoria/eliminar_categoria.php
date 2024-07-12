<?php
include '../../Backend/config/baseDeDatos.php';

if (isset($_POST['id'])) {
    $id_categoria = $_POST['id'];
    $estado = 0;

    try {
        $query = $conn->prepare("UPDATE categorias SET estado = :estado WHERE id_categoria = :id_categoria");
        $query->bindParam(':estado', $estado);
        $query->bindParam(':id_categoria', $id_categoria);

        if ($query->execute()) {
            header('Location: ../../Frontend/reportes/reporte_cat.php?status=success');
        } else {
            header('Location: ../../Frontend/reportes/reporte_cat.php?status=error');
        }
    } catch (PDOException $e) {
        error_log($e->getMessage(), 3, '../../Backend/logs/error.log');
        header('Location: ../../Frontend/reportes/reporte_cat.php?status=error');
    }
} else {
    header('Location: ../../Frontend/reportes/reporte_cat.php?status=invalid');
}
?>

