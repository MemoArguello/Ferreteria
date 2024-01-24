<?php
include '../config/baseDeDatos.php';

$id_caja = $_GET['id_caja'];
$ingreso = $_POST['ingreso'];
$egreso = $_POST['egreso'];
$saldo_cierre = $ingreso - $egreso;
$estado = 'Cerrado';

$fechaActual = date("Y-m-d H:i:s");

$conexiondb = conectardb();

$id_caja = $_POST['id_caja'];
$query = "UPDATE caja SET fecha_cierre='" . $fechaActual . "',estado='" .$estado . "', saldo_cierre='" .$saldo_cierre . "' WHERE id_caja=" . $id_caja;

// Verificar si la preparación de la consulta fue exitosa
    // Asociar parámetros y ejecutar la actualización
    $respuesta = mysqli_query($conexiondb, $query);

    // Verificar si la actualización fue exitosa
    if ($respuesta) {
        header("Location: ../../Frontend/reportes/reporte_caja.php");
        exit();
    } else {
        // Manejar el caso en que la actualización falla
        echo "Error al actualizar la caja: " . mysqli_error($conexiondb);
    }

    // Cerrar la declaración preparada
    mysqli_stmt_close($stmt);


// Cerrar la conexión a la base de datos
mysqli_close($conexiondb);

?>