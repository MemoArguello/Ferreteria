<?php
include '../../Backend/config/baseDeDatos.php';

if(empty($_POST['codigo_factura']) || empty($_POST['cliente']) || empty($_POST['tipo'])){
    echo "<script>alert('Complete los datos');
    window.location.href='../../Frontend/venta/venta.php'</script>";
    exit;
}else{
    $cliente = $_POST['cliente'];
    $tipo = $_POST['tipo'];
    $usuario = $_POST['id_usuario'];
    $evento = 'Se creo una factura';
    $fechaActual = date("Y-m-d H:i:s");

    try {
            $query2 = "INSERT INTO factura_cabecera (cliente, tipo) VALUES (?, ?)";
            $stmt2 = $conn->prepare($query2);
            $stmt2->execute([$codigo, $cliente, $tipo]);

            $query4 = "INSERT INTO auditoria (id_usuario, evento, fecha) VALUES (?, ?, ?)";
            $stmt4 = $conn->prepare($query4);
            $stmt4->execute([$usuario, $evento, $fechaActual]);

            echo "<script>alert('Registro Exitoso');
            window.location.href='../../Frontend/venta/venta.php'</script>";

    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}