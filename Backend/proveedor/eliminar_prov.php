<?php
include '../config/baseDeDatos.php';

if (isset($_POST['id'])) {
    $id_proveedor = $_POST['id'];

    try {
        $query = $conn->prepare("DELETE FROM proveedores WHERE id_proveedor = :id_proveedor");
        $query->bindParam(':id_proveedor', $id_proveedor, PDO::PARAM_INT);

        if ($query->execute()) {
            header('Location: ../../Frontend/reportes/reporte_prov.php');
            exit();
        } else {
            header('Location: ../../Frontend/reportes/reporte_prov.php');
            exit();
        }
    } catch (PDOException $e) {
        if ($e->getCode() == '23000') { // Código para violación de integridad
            echo "<script>alert('No se puede eliminar el proveedor porque tiene productos asociados.');
            window.location.href='../../Frontend/reportes/reporte_prov.php'</script>";
        } else {
            echo "Error: " . $e->getMessage();
        }
    }
} else {
    header('Location: ../../Frontend/reportes/reporte_prov.php');
    exit();
}
?>
