<?php
include '../../Backend/config/baseDeDatos.php';

$id_cliente = $_POST['id'];

try {
    $query = $conn->prepare("DELETE FROM cliente WHERE id_cliente= :id_cliente");
    $query->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);

    if ($query->execute()) {
        echo "<script>alert('Cliente Eliminado'); window.location.href='../../Frontend/reportes/reporte_cliente.php'</script>";
    } else {
        echo "<script>alert('No se pudo Eliminar'); window.location.href='../../Frontend/reportes/reporte_cliente.php'</script>";
    }
} catch (Exception $e) {
    // Si ocurre una excepción, mostrar un mensaje de error
    echo "<script>alert('No se pudo Eliminar'); window.location.href='../../Frontend/reportes/reporte_cliente.php'</script>";
} finally {
    // Cerrar la conexión
}
?>