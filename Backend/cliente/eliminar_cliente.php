<?php
include '../config/baseDeDatos.php';

$id_cliente = $_GET['id_cliente'];

$conexiondb = conectardb();

$query ="DELETE FROM cliente WHERE id_cliente=".$id_cliente;

$respuesta= mysqli_query($conexiondb, $query);

if ($respuesta) {
    echo "<script>alert('Usuario Eliminado');
    window.location.href='../../Frontend/reportes/reporte_cliente.php'</script>";
} else {
    echo "<script>alert('No se pudo Eliminar');
    window.location.href='../../Frontend/reportes/reporte_cliente.php'</script>";
}
?>