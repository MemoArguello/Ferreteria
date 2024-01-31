<?php
include '../config/baseDeDatos.php';
if (!empty($_POST)) {
    $alert = '';
if (empty($_POST['codigo_factura']) || empty($_POST['tipo']) || empty($_POST['fecha_creacion'])){
    echo "<script>alert('Complete los datos');
    window.location.href='../../Frontend/reportes/reporte_venta.php'</script>";
    exit;
}else{
    $conexiondb = conectardb();

            $nombre_prov = $_POST['codigo_factura'];
            $cliente = $_POST['cliente'];
            $tipo = $_POST['tipo'];
            $fecha = $_POST['fecha_creacion'];
            $usuario = $_POST["id_usuario"];
            $fechaActual = date("Y-m-d H:i:s");
            $evento = 'Se editó una venta';
            $id_factura = $_POST['id_factura'];
            $query = "UPDATE facturas SET codigo_factura='" . $nombre_prov . "', tipo='" . $tipo . "', fecha_creacion='" . $fecha . "' WHERE id_factura='" . $id_factura . "'";
            
            $respuesta = mysqli_query($conexiondb, $query);

            $query2 = "INSERT INTO auditoria (id_usuario, evento, fecha) VALUES 
                ('$usuario', '$evento', '$fechaActual')";
            $respuesta2 = mysqli_query($conexiondb, $query2);

                if ($respuesta and $respuesta2) {
                    echo "<script>alert('Se editó correctamente');
                    window.location.href='../../Frontend/reportes/reporte_venta.php'</script>";
                } else {
                    echo "<script>alert('Registro Fallido');
                    window.location.href='../../Frontend/reportes/reporte_venta.php'</script>";
                }

        mysqli_close($conexiondb);
    }
}
?>