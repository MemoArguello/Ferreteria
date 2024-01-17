<?php

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["productoId"])) {
    // Obtener el costo del producto desde la base de datos
    $mysqli = new mysqli("localhost", "root", "", "ferreteria");

    $productoId = $_GET["productoId"];
    $query = "SELECT precio FROM productos WHERE id_producto = ?";
   
    if ($stmt = $mysqli->prepare($query)) {
        $stmt->bind_param("i", $productoId);
        $stmt->execute();
        $stmt->bind_result($costo);

        if ($stmt->fetch()) {
            echo $costo;
        } else {
            echo "Error: No se encontró el costo del producto.";
        }

        $stmt->close();
    } else {
        echo "Error en la preparación de la consulta.";
    }

    $mysqli->close();
} else {
    echo "Error en la solicitud.";
}
?>
