<?php
// Realizar la búsqueda de productos en la base de datos y devolver los resultados
if (isset($_POST['query'])) {
    $conexion = new mysqli('localhost', 'root', '', 'ferreteria');

    $query = $_POST['query'];
    $sql = "SELECT * FROM productos WHERE nombre_producto LIKE '%$query%'";
    $result = $conexion->query($sql);

    if ($result->num_rows > 0) {
        echo "<option value=''>Seleccionar Producto</option>";
        while ($row = $result->fetch_assoc()) {
            echo "<option value='" . $row['nombre_producto'] . "'>" . $row['nombre_producto'] . "</option>";
        }
    } else {
        echo "<option value=''>No se encontraron productos</option>";
    }

    $conexion->close();
}
?>
