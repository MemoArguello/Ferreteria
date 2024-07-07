<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $codigoFactura = $_POST["codigo_factura"];
    $clienteId = $_POST["cliente"];
    $tipo = $_POST["tipo"];
    $fechaActual = date("Y-m-d H:i:s");
    $usuario = $_POST["id_usuario"];
    // Conectar a la base de datos (ajusta las credenciales según tu configuración)
    $mysqli = new mysqli("localhost", "root", "", "ferreteria");

    // Verificar la conexión
    if ($mysqli->connect_error) {
        die("Error en la conexión a la base de datos: " . $mysqli->connect_error);
    }

    // Iniciar una transacción para garantizar la consistencia de la base de datos
    $mysqli->begin_transaction();
    function obtenerCostoProducto($idProducto) {
        global $mysqli;
    
        $query = "SELECT precio FROM productos WHERE id_producto = ?";
        
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("i", $idProducto);
        
        $stmt->execute();
        
        $stmt->bind_result($costo);
        $stmt->fetch();
        
        $stmt->close();
    
        return $costo;
    }
    
    try {
        $insertFactura = $mysqli->prepare("INSERT INTO facturas (codigo_factura, cliente, tipo, fecha_creacion) VALUES (?, ?, ?, ?)");
        $insertFactura->bind_param("siss", $codigoFactura, $clienteId, $tipo, $fechaActual);
        $insertFactura->execute();
        $facturaId = $mysqli->insert_id;

        // Insertar los detalles de la factura en la tabla detalle_factura
        $productos = $_POST["producto"];
        $cantidades = $_POST["cantidad"];

        foreach ($productos as $key => $idProducto) {
            $cantidad = $cantidades[$key];

            // Obtener el stock actual del producto
            $stockActual = obtenerStockProducto($idProducto);

            // Verificar si hay suficiente stock disponible
            if ($cantidad > $stockActual) {
                throw new Exception("No hay suficiente stock disponible para el producto con ID $idProducto");
            }

            // Actualizar el stock del producto
            $nuevoStock = $stockActual - $cantidad;
            actualizarStockProducto($idProducto, $nuevoStock);

            $costoUnitario = obtenerCostoProducto($idProducto);
            $total = $cantidad * $costoUnitario;

            $insertDetalle = $mysqli->prepare("INSERT INTO detalle_factura (id_factura, producto, cantidad, costo_unitario, total) VALUES (?, ?, ?, ?, ?)");
            $insertDetalle->bind_param("iiidd", $facturaId, $producto, $cantidad, $costoUnitario, $total);
            $insertDetalle->execute();
        }

        // Obtener el ingreso actual de la caja
        $obtenerIngreso = $mysqli->prepare("SELECT ingreso FROM caja WHERE estado = 'Abierto'");
        $obtenerIngreso->execute();
        $obtenerIngreso->bind_result($ingresoActual);
        $obtenerIngreso->fetch();
        $obtenerIngreso->close();

        // Calcular el nuevo ingreso sumando el monto anterior con el nuevo monto
        $nuevoIngreso = $ingresoActual + $total;

        $evento = 'Venta de Productos';

        $insertAuditoria = $mysqli->prepare("INSERT INTO auditoria (id_usuario, evento, fecha) VALUES (?, ?, ?)");
        $insertAuditoria->bind_param("iss", $usuario, $evento, $fechaEvento);
        $insertAuditoria->execute();

        // Confirmar la transacción
        $mysqli->commit();

        echo "<script>alert('Factura procesada exitosamente');
        window.location.href='./venta.php'</script>";
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

// Función para obtener el stock actual del producto
function obtenerStockProducto($idProducto) {
    global $mysqli;

    $query = "SELECT stock FROM productos WHERE id_producto = ?";

    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("i", $idProducto);
    $stmt->execute();
    $stmt->bind_result($stock);
    $stmt->fetch();
    $stmt->close();

    return $stock;
}

// Función para actualizar el stock del producto
function actualizarStockProducto($idProducto, $nuevoStock) {
    global $mysqli;

    $query = "UPDATE productos SET stock = ? WHERE id_producto = ?";

    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("ii", $nuevoStock, $idProducto);
    $stmt->execute();
    $stmt->close();
}
