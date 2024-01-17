<?php
include '../../Backend/config/baseDeDatos.php';

$id_categoria = $_GET['id_categoria'];

$conexiondb = conectardb();
$query = "SELECT * FROM productos WHERE categoria = '$id_categoria'";
$resultado = mysqli_query($conexiondb, $query);

echo "<option value=''>Seleccione una opción</option>";
while ($producto = mysqli_fetch_assoc($resultado)) {
    echo "<option value='" . $producto['id_producto'] . "'>" . $producto['nombre_producto'] . "</option>";
}


?>
