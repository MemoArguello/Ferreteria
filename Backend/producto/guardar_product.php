<?php
include '../config/baseDeDatos.php';

if (empty($_POST['nombre_producto']) || empty($_POST['categoria']) || empty($_POST['lote']) || empty($_POST['stock']) || empty($_POST['precio']) || empty($_POST['precio_compra']) || empty($_POST['id_proveedor'])){
    echo "<script>alert('Complete los datos');
    window.location.href='../../Frontend/productos/registrar_productos.php'</script>";
    exit; 
} else {
    $nombre = $_POST['nombre_producto'];
    $categoria = $_POST['categoria'];
    $lote = $_POST['lote'];
    $stock = $_POST['stock'];
    $precio = $_POST['precio'];
    $precio_compra = $_POST['precio_compra'];
    $editar = $_POST['editar'];
    $fechaActual = date("Y-m-d H:i:s");
    $evento = 'Registro de Producto';

    try {
        if ($editar == "si") {
            $id_producto = $_POST['id_producto'];
            $query = $conn->prepare("UPDATE productos SET nombre_producto=:nombre, categoria=:categoria, lote=:lote, stock=:stock, precio=:precio, precio_compra=:precio_compra WHERE id_producto=:id_producto");
            $respuesta = $query->execute([
                ":nombre" => $nombre,
                ":categoria" => $categoria,
                ":lote" => $lote,
                ":stock" => $stock,
                ":precio" => $precio,
                ":precio_compra" => $precio_compra,
                ":id_producto" => $id_producto
            ]);

            if ($respuesta) {
                echo "<script>alert('Se editó correctamente');
                window.location.href='../../Frontend/reportes/reporte_prod.php'</script>";
            } else {
                echo "<script>alert('Registro Fallido');
                window.location.href='../../Frontend/reportes/reporte_prod.php'</script>";
            }
        } else {
            $usuario = $_POST["id_usuario"];
            $id_proveedor = $_POST['id_proveedor'];
            $query2 = $conn->prepare("INSERT INTO productos (nombre_producto, categoria, lote, stock, precio, precio_compra, id_proveedor) VALUES (:nombre, :categoria, :lote, :stock, :precio, :precio_compra, :id_proveedor)");
            $respuesta2 = $query2->execute([
                ":nombre" => $nombre,
                ":categoria" => $categoria,
                ":lote" => $lote,
                ":stock" => $stock,
                ":precio" => $precio,
                ":precio_compra" => $precio_compra,
                ":id_proveedor" => $id_proveedor
            ]);

            $query3 = $conn->prepare("UPDATE caja SET egreso=:precio_compra WHERE estado = 'Abierto'");
            $respuesta3 = $query3->execute([":precio_compra" => $precio_compra]);

            $query4 = $conn->prepare("INSERT INTO auditoria (id_usuario, evento, fecha) VALUES (:id_usuario, :evento, :fecha)");
            $respuesta4 = $query4->execute([
                ":id_usuario" => $usuario,
                ":evento" => $evento,
                ":fecha" => $fechaActual
            ]);

            if ($respuesta2 && $respuesta3 && $respuesta4) {
                echo "<script>alert('Registro Exitoso');
                window.location.href='../../Frontend/reportes/reporte_prod.php'</script>";
            } else {
                echo "<script>alert('Registro Fallido');
                window.location.href='../../Frontend/reportes/reporte_prod.php'</script>";
            }
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    $conn = null; // Cerrar conexión
}
?>
