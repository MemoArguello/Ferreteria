<?php
try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        require "../config/baseDeDatos.php";

        $nombre_empresa = $_POST['nombre_empresa'];
        $id_dato = $_POST['id_datos']; 
        $imagen_actual = $_POST['imagen_actual'];

        if ($_FILES["imagen_url"]["error"] == UPLOAD_ERR_OK) {
            $imagen_nueva = $_FILES["imagen_url"]["name"];
            $dir = "images/" . basename($imagen_nueva);
            
            if (move_uploaded_file($_FILES["imagen_url"]["tmp_name"], $dir)) {
                $imagen = $imagen_nueva;
            } else {
                echo "<script>alert('Error al subir la nueva imagen');</script>";
                exit;
            }
        } else {
            $imagen = $imagen_actual;
        }

        $sentencia = $conn->prepare("UPDATE datos_empresa SET nombre_empresa = ?, imagen_url = ? WHERE id_datos = ?;");
        $resultado = $sentencia->execute([$nombre_empresa, $imagen, $id_dato]);
        
        if ($resultado) {
            echo "<script>alert('Datos actualizados correctamente');
            window.location.href='../../Frontend/configuracion/informacion.php';</script>";
            exit;
        } else {
            echo "<script>alert('Error al actualizar los datos');
            window.location.href='../../Frontend/configuracion/informacion.php';</script>";
            exit;
        }
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
