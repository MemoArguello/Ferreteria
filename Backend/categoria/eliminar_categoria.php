<?php
include '../config/baseDeDatos.php';

if (isset($_POST['id'])) {
$id_categoria = $_POST['id'];

    try {
        $query = $conn->prepare("DELETE FROM categorias WHERE id_categoria = :id_categoria");
        $query->bindParam(':id_categoria', $id_categoria, PDO::PARAM_INT);

        if ($query->execute()) {
            header('location: ../../Frontend/reportes/reporte_cat.php');
        } else {
            header('location: ../../Frontend/reportes/reporte_cat.php');
        }
    } catch (Exception $e) {
        header('location: ../../Frontend/reportes/reporte_cat.php');
    } 
}else {
    header('location: ../../Frontend/reportes/reporte_cat.php');
}
?>
