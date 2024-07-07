<?php
require "../../backend/config/baseDeDatos.php";

$id_categoria = $_GET['id_categoria'];

$queryProductos = $conn->prepare("SELECT id_producto, nombre FROM productos WHERE id_categoria = ?");
$queryProductos->execute([$id_categoria]);

$options = "";
while ($rowProducto = $queryProductos->fetch(PDO::FETCH_ASSOC)) {
    $options .= "<option value='{$rowProducto['id_producto']}'>{$rowProducto['nombre']}</option>";
}

echo $options;
?>
