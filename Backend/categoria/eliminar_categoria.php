<?php
include '../config/baseDeDatos.php';

$id_categoria = $_POST['id'];

try {
    $query = $conn->prepare("DELETE FROM categorias WHERE id_categoria = :id_categoria");
    $query->bindParam(':id_categoria', $id_categoria, PDO::PARAM_INT);

    if ($query->execute()) {
        echo "<script>alert('Categoría Eliminada'); window.location.href='../../Frontend/reportes/reporte_cat.php'</script>";
    } else {
        echo "<script>alert('No se pudo eliminar la categoría'); window.location.href='../../Frontend/reportes/reporte_cat.php'</script>";
    }
} catch (Exception $e) {
    echo "<script>alert('No se pudo eliminar la categoría porque esta relacionada'); window.location.href='../../Frontend/reportes/reporte_cat.php'</script>";
} finally {
}
?>
