<?php
require "../../backend/config/baseDeDatos.php";

if (isset($_GET['id_departamento'])) {
    $id_departamento = $_GET['id_departamento'];

    try {
        $query = $conn->prepare("SELECT * FROM ciudades WHERE id_departamento = :id_departamento");
        $query->bindParam(':id_departamento', $id_departamento);
        $query->execute();
        $resultado = $query->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode($resultado);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>