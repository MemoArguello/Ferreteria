<?php
include ('../config/baseDeDatos.php');

$conexiondb = conectardb();

// Verificar si hay una caja abierta
$queryVerificar = "SELECT COUNT(*) as numCajasAbiertas FROM caja WHERE estado='Abierto'";
$resultadoVerificar = mysqli_query($conexiondb, $queryVerificar);

if ($resultadoVerificar) {
    $fila = mysqli_fetch_assoc($resultadoVerificar);
    $numCajasAbiertas = $fila['numCajasAbiertas'];

    // Si no hay cajas abiertas, proceder a abrir una nueva caja
    if ($numCajasAbiertas == 0) {
        $fechaActual = date("Y-m-d H:i:s");
        $evento = 'Apertura de Caja';
        $usuario = $_GET["id_usuario"];

        $queryInsertar = "INSERT INTO caja (fecha_apertura, estado) VALUES ('$fechaActual', 'Abierto')";
        $respuesta = mysqli_query($conexiondb, $queryInsertar);

        $query4 = "INSERT INTO auditoria (id_usuario, evento, fecha) VALUES 
        ('$usuario', '$evento', '$fechaActual')";

    $respuesta4 = mysqli_query($conexiondb, $query4);

        if ($respuesta and $respuesta4) {
            header("Location: ../../Frontend/reportes/reporte_caja.php");
            exit();
        } else {
            header("Location: ../../Frontend/reportes/reporte_caja.php");
            exit();
        }
    } else {
        echo "<script>alert('Ya hay una caja Abierta');
        window.location.href='../../Frontend/reportes/reporte_caja.php'</script>";
    }
} else {
    // Manejar errores en la consulta de verificación si es necesario
    echo "Error al verificar cajas abiertas";
}

mysqli_close($conexiondb);
?>
