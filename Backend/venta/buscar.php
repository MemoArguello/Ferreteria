<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener la información de la venta
    $nombre_cliente = $_POST["nombre_cliente"];
    $productos_seleccionados = json_decode($_POST["productos_seleccionados"]);
    $cantidades = $_POST["lote"];
    $total_a_pagar = $_POST["stock"];

    // Procesar la venta, almacenar en la base de datos, etc.
    // Aquí deberías implementar la lógica de tu aplicación para manejar la venta

    // Ejemplo: Imprimir la información de la venta
    echo "<h2>Venta realizada a: $nombre_cliente</h2>";
    echo "<ul>";
    for ($i = 0; $i < count($productos_seleccionados); $i++) {
        echo "<li>$cantidades[$i] x $productos_seleccionados[$i]</li>";
    }
    echo "</ul>";
} else {
    // Redirigir si se intenta acceder directamente a buscar.php
    header("Location: venta.php");
    exit();
}
?>
