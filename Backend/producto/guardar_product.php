<?php
include '../config/baseDeDatos.php';
if (empty($_POST['nombre_producto']) || empty($_POST['categoria']) || empty($_POST['lote']) || empty($_POST['stock']) || empty($_POST['precio']) || empty($_POST['informacion'])){
    echo "<script>alert('Complete los datos');
    window.location.href='../../Frontend/productos/registrar_productos.php'</script>";
    exit; 
}else{
        $nombre = $_POST['nombre_producto'];
        $categoria = $_POST['categoria'];
        $lote = $_POST['lote'];
        $stock = $_POST['stock'];
        $precio = $_POST['precio'];
        $informacion = $_POST['informacion'];
        $editar = $_POST['editar'];

        $conexiondb = conectardb();

        if ($editar == "si") {
            $id_producto = $_POST['id_producto'];
            $query = "UPDATE productos SET nombre_producto='" . $nombre . "', categoria='" . $categoria . "'
                    ,lote ='" . $lote . "', stock= '" . $stock . "', precio= '" . $precio . "', informacion= '" . $informacion . "' 
                    WHERE id_producto='" . $id_producto . "'";
            
            $respuesta = mysqli_query($conexiondb, $query);

            if ($respuesta) {
                    echo "<script>alert('Se editó correctamente');
                    window.location.href='../../Frontend/reportes/reporte_prod.php'</script>";
                } else {
                    echo "<script>alert('Registro Fallido');
                    window.location.href='../../Frontend/reportes/reporte_prod.php'</script>";
                }

        } else {
            $id_proveedor = $_POST['id_proveedor'];
            $query2 = "INSERT INTO productos (nombre_producto, categoria, lote, stock, precio, id_proveedor, informacion) VALUES 
                ('$nombre', '$categoria', '$lote', '$stock', '$precio', '$id_proveedor','$informacion')";

            $respuesta2 = mysqli_query($conexiondb, $query2);

            if ($respuesta2) {
                    echo "<script>alert('Registro Exitoso');
                    window.location.href='../../Frontend/reportes/reporte_prod.php'</script>";
                } else {
                    echo "<script>alert('Registro Exitoso');
                    window.location.href='../../Frontend/reportes/reporte_prod.php'</script>";
                }
        }
        mysqli_close($conexiondb);
    }

?>