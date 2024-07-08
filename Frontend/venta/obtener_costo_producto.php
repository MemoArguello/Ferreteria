<?php
include '../../Backend/config/baseDeDatos.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["productoId"])) {
    $productoId = $_GET["productoId"];
    
    try {
        $consulta = $conn->query("SELECT precio FROM productos WHERE id_producto = $productoId");
        $consulta->execute();
        $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
        
        if ($resultado) {
            echo $resultado['precio'];
        } else {
            echo "Error: No se encontró el costo del producto.";
        }
    } catch (PDOException $e) {
        echo "Error en la preparación de la consulta: " . $e->getMessage();
    }
} else {
    echo "Error en la solicitud.";
}

