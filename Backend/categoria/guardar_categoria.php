<?php
include '../config/baseDeDatos.php';
if (!empty($_POST)) {
    $alert = '';
if (empty($_POST['descripcion'])){
    echo "<script>alert('Complete los datos');
    window.location.href='../../Frontend/productos/registrar_categoria.php'</script>";
    exit;
}else{
        $descripcion = $_POST['descripcion'];
        $editar = $_POST['editar'];

        $conexiondb = conectardb();

        if ($editar == "si") {
            $id_categoria = $_POST['id_categoria'];
            $query = "UPDATE categorias SET descripcion='" . $descripcion . "' WHERE id_categoria='" . $id_categoria . "'";
            
            $respuesta = mysqli_query($conexiondb, $query);

            if ($respuesta) {
                    echo "<script>alert('Se editó correctamente');
                    window.location.href='../../Frontend/reportes/reporte_cat.php'</script>";
                } else {
                    echo "<script>alert('Registro Fallido');
                    window.location.href='../../Frontend/reportes/reporte_cat.php'</script>";
                }

        } else {
            $query2 = "INSERT INTO categorias (descripcion) VALUES 
                ('$descripcion')";

            $respuesta2 = mysqli_query($conexiondb, $query2);

            if ($respuesta2) {
                    echo "<script>alert('Registro Exitoso');
                                        window.location.href='../../Frontend/reportes/reporte_cat.php'</script>";
                } else {
                    echo "<script>alert('Registro Exitoso');
                    window.location.href='../../Frontend/reportes/reporte_cat.php'</script>";
                }
        }
        mysqli_close($conexiondb);
    }
}
?>