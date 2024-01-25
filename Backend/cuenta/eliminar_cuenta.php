<?php
include '../../Backend/config/baseDeDatos.php';

$id_usuario = $_GET['id_usuario'];
$conexiondb = conectardb();

try {
    $query = "DELETE FROM usuarios WHERE id_usuario=" . $id_usuario;
    $respuesta = mysqli_query($conexiondb, $query);

    if ($respuesta) {
        echo "<script>alert('Usuario Eliminado');
        window.location.href='../../Frontend/reportes/reporte_cuenta.php'</script>";
    } else {
        echo "<script>alert('No se pudo Eliminar');
        window.location.href='../../Frontend/reportes/reporte_cuenta.php'</script>";
    }
} catch (Exception $e) {
    // Si ocurre una excepción, mostrar un mensaje de error
    echo "<script>alert('No se pudo Eliminar');
    window.location.href='../../Frontend/reportes/reporte_cuenta.php'</script>";} finally {
    // Cerrar la conexión
    mysqli_close($conexiondb);
}
?>