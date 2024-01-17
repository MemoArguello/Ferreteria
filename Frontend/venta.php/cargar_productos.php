<?php
// cargar_productos.php

// Aquí deberías incluir la lógica de conexión a la base de datos
// y cualquier otra configuración necesaria

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id_categoria"])) {
    $idCategoria = $_GET["id_categoria"];

    // Realizar la consulta para obtener los productos de la categoría seleccionada
    $mysqli = new mysqli("localhost", "root", "", "ferreteria");
    $query = "SELECT id_producto, nombre_producto FROM productos WHERE categoria = ?";
    
    if ($stmt = $mysqli->prepare($query)) {
        $stmt->bind_param("i", $idCategoria);
        $stmt->execute();
        $stmt->bind_result($idProducto, $nombreProducto);

        // Construir opciones de productos
        $options = "<option value='' disabled selected>Selecciona un producto</option>";

        while ($stmt->fetch()) {
            $options .= "<option value='{$idProducto}'>{$nombreProducto}</option>";
        }

        echo $options;

        $stmt->close();
    } else {
        // Manejar el error de preparación de consulta
        echo "Error en la preparación de la consulta.";
    }

    $mysqli->close();
} else {
    // Manejar el error de solicitud incorrecta
    echo "Error en la solicitud.";
}
?>
