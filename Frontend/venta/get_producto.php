<?php
require "../../backend/config/baseDeDatos.php";

if (isset($_GET['id_categoria'])) {
    $id_categoria = $_GET['id_categoria'];

    try {
        $query = $conn->prepare("SELECT * FROM productos WHERE categoria = :id_categoria");
        $query->bindParam(':id_categoria', $id_categoria);
        $query->execute();
        $resultado = $query->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode($resultado);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
