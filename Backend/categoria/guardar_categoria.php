<?php
include '../config/baseDeDatos.php';

if (!empty($_POST)) {
    $alert = '';

    if (empty($_POST['descripcion'])) {
        echo "<script>alert('Complete los datos');
        window.location.href='../../Frontend/productos/registrar_categoria.php'</script>";
        exit;
    } else {
        $descripcion = $_POST['descripcion'];
        $editar = $_POST['editar'];

        try {
            // Utilizar la conexión existente
            global $conn;

            if ($editar == "si") {
                $id_categoria = $_POST['id_categoria'];
                $query = "UPDATE categorias SET descripcion=:descripcion WHERE id_categoria=:id_categoria";
                
                $stmt = $conn->prepare($query);
                $stmt->bindParam(':descripcion', $descripcion);
                $stmt->bindParam(':id_categoria', $id_categoria);
                $stmt->execute();

                echo "<script>alert('Se editó correctamente');
                window.location.href='../../Frontend/reportes/reporte_cat.php'</script>";

            } else {
                $query = "INSERT INTO categorias (descripcion) VALUES (:descripcion)";
                
                $stmt = $conn->prepare($query);
                $stmt->bindParam(':descripcion', $descripcion);
                $stmt->execute();

                echo "<script>alert('Registro Exitoso');
                window.location.href='../../Frontend/reportes/reporte_cat.php'</script>";
            }
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
?>
