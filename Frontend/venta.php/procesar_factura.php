<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $codigoFactura = $_POST["codigo_factura"];
    $clienteId = $_POST["cliente"];
    $tipo = $_POST["tipo"];
    $fechaActual = date("Y-m-d H:i:s");

    // Conectar a la base de datos (ajusta las credenciales según tu configuración)
    $mysqli = new mysqli("localhost", "root", "", "ferreteria");

    // Verificar la conexión
    if ($mysqli->connect_error) {
        die("Error en la conexión a la base de datos: " . $mysqli->connect_error);
    }

    // Iniciar una transacción para garantizar la consistencia de la base de datos
    $mysqli->begin_transaction();

    try {
        $insertFactura = $mysqli->prepare("INSERT INTO facturas (codigo_factura, cliente, tipo, fecha_creacion) VALUES (?, ?, ?, ?)");
        $insertFactura->bind_param("siss", $codigoFactura, $clienteId, $tipo, $fechaActual);
        $insertFactura->execute();
        $facturaId = $mysqli->insert_id; 

        // Insertar los detalles de la factura en la tabla detalle_factura
        $productos = $_POST["producto"];
        foreach ($productos as $producto) {
            $idProducto = $producto["id_producto"];
            $cantidad = $producto["cantidad"];
            $costoUnitario = $producto["costo"];
            $total = $producto["total"];

            $insertDetalle = $mysqli->prepare("INSERT INTO detalle_factura (id_factura, id_producto, cantidad, costo_unitario, total) VALUES (?, ?, ?, ?, ?)");
            $insertDetalle->bind_param("iiidd", $facturaId, $idProducto, $cantidad, $costoUnitario, $total);
            $insertDetalle->execute();
        }

        // Confirmar la transacción
        $mysqli->commit();

        echo "Factura procesada exitosamente";
    } catch (Exception $e) {
        // Revertir la transacción en caso de error
        $mysqli->rollback();

        echo "Error al procesar la factura: " . $e->getMessage();
    } finally {
        // Cerrar la conexión
        $mysqli->close();
    }
} else {
    // Manejar el error de solicitud incorrecta
    echo "Error en la solicitud.";
}
?>
