<?php
include '../config/baseDeDatos.php';

$id_cliente = $_GET['id_cliente'];

$conexiondb = conectardb();

try{$query ="DELETE * FROM cliente WHERE id_cliente=".$id_cliente;
}catch (Exception){
    echo "<script>alert('No se pudo eliminar el Registro');
    window.location.href='../../Frontend/reportes/reporte_cliente.php'</script>";
    exit();
}

$respuesta= mysqli_query($conexiondb, $query);

if ($respuesta) {
    echo "<script>alert('Usuario Eliminado');
    window.location.href='../../Frontend/reportes/reporte_cliente.php'</script>";
} else {
    echo "<script>alert('No se pudo Eliminar');
    window.location.href='../../Frontend/reportes/reporte_cliente.php'</script>";
}
?>