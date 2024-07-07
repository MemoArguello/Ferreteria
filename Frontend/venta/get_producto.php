<?php
include '../../Backend/config/baseDeDatos.php';

$id_categoria = $_GET['id_categoria'];


$query = $conn->query("SELECT * FROM productos WHERE categoria = ?");
$stmt->execute();
$resultado = $stmt->get_result();

echo "<option value=''>Seleccione una opción</option>";
while ($producto = $resultado->fetch_assoc()) {
    echo "<option value='" . $producto['id_producto'] . "'>" . $producto['nombre_producto'] . "</option>";
}

$stmt->close();
$conexiondb->close();
?>
