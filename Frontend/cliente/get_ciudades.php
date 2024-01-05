<?php
include '../../Backend/config/baseDeDatos.php';

$departamentoId = $_GET['departamento_id'];

$conexiondb = conectardb();
$query = "SELECT * FROM ciudades WHERE id_departamento = '$departamentoId'";
$resultado = mysqli_query($conexiondb, $query);

echo "<option value=''>Seleccione una opción</option>";
while ($ciudad = mysqli_fetch_assoc($resultado)) {
    echo "<option value='" . $ciudad['id_ciudad'] . "'>" . $ciudad['nombre'] . "</option>";
}
?>
