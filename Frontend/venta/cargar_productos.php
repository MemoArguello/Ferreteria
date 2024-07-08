<?php
// Incluir el archivo de configuración de la base de datos
include '../../Backend/config/baseDeDatos.php';

// Obtener el id de categoría desde la solicitud GET
$id_categoria = $_GET['id_categoria'];

// Verificar que el id de categoría no esté vacío
if (!empty($id_categoria)) {
    try {
        // Consulta preparada para obtener productos de la categoría especificada
        $stmt = $conn->prepare("SELECT id_producto, nombre_producto FROM productos WHERE categoria = :id_categoria");
        $stmt->bindParam(':id_categoria', $id_categoria, PDO::PARAM_INT); // Vincular el parámetro como entero

        // Ejecutar la consulta preparada
        $stmt->execute();

        // Obtener resultados de la consulta
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Mostrar opciones del select
        echo "<option value=''>Seleccione una opción</option>";
        foreach ($resultados as $producto) {
            echo "<option value='" . $producto['id_producto'] . "'>" . $producto['nombre_producto'] . "</option>";
        }

    } catch (PDOException $e) {
        // Manejo de errores de PDO
        echo "<option value=''>Error: " . $e->getMessage() . "</option>";
    } finally {
        // Cerrar la declaración y la conexión
        if (isset($stmt)) {
            $stmt->closeCursor(); // Cerrar cursor para asegurar que todas las filas sean liberadas
        }
        $conn = null; // Cerrar la conexión
    }
} else {
    echo "<option value=''>Seleccione una opción</option>"; // Manejo de error si no se proporciona id_categoria
}
?>
