<?php
include '../../Backend/config/baseDeDatos.php';

$id_usuario = $_POST['id'];

try {
    $query = $conn->prepare("DELETE FROM usuarios WHERE id_usuario = :id_usuario");
    $query->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);

    if ($query->execute()) {
        echo "<script>alert('Usuario Eliminado'); window.location.href='../../Frontend/reportes/reporte_cuenta.php'</script>";
    } else {
        echo "<script>alert('No se pudo eliminar el usuario'); window.location.href='../../Frontend/reportes/reporte_cuenta.php'</script>";
    }
} catch (Exception $e) {
    echo "<script>alert('No se pudo eliminar el usuario porque esta relacionada'); window.location.href='../../Frontend/reportes/reporte_cuenta.php'</script>";
} finally {
}
?>