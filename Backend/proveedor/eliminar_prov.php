<?php
include '../../Backend/config/baseDeDatos.php';

$id_proveedor = $_GET['id_proveedor'];

$conexiondb = conectardb();

$query ="DELETE FROM proveedores WHERE id_proveedor=".$id_proveedor;

$respuesta= mysqli_query($conexiondb, $query);

if ($respuesta) {
    echo "<script>alert('Usuario Eliminado');
    window.location.href='../../Frontend/reportes/reporte_prov.php'</script>";
} else {
    echo "<script>alert('No se pudo Eliminar');
    window.location.href='../../Frontend/reportes/reporte_prov.php'</script>";
}
?>