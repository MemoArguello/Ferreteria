<?php
// Conecta a tu base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ferreteria";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtiene el valor de búsqueda desde la URL
$q = $_GET['q'];

// Realiza la consulta a la base de datos
$sql = "SELECT * FROM categorias WHERE desdcripcion LIKE '%$q%'";
$result = $conn->query($sql);

// Muestra los resultados
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<p>ID: " . $row["id"]. " - Nombre: " . $row["nombre"]. " - Descripción: " . $row["descripcion"]. "</p>";
    }
} else {
    echo "No se encontraron resultados";
}

$conn->close();
?>
