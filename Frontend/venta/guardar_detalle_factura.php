<?php
include '../../Backend/config/baseDeDatos.php';
try{
    $id_factura_cabecera = $_POST["id_factura_cabecera"];
    $id_producto = $_POST["id_producto"];
    $cantidad = $_POST["cantidad"];
    $precio_unitario = $_POST["precio"];
    $total_pagar = $_POST["subtotal"];

    $stmt = $conn->prepare("INSERT INTO detalle_factura (id_factura, productos, cantidad, precio_unitario, total_pagar) VALUES (:id_factura, :productos, :cantidad, :precio_unitario, :total_pagar)");
    $stmt->bindParam(':id_factura',$id_factura_cabecera, PDO::PARAM_INT);
    $stmt->bindParam(':productos',$id_producto, PDO::PARAM_INT);
    $stmt->bindParam(':cantidad',$cantidad, PDO::PARAM_INT);
    $stmt->bindParam(':precio_unitario',$precio_unitario, PDO::PARAM_STR);
    $stmt->bindParam(':total_pagar',$total_pagar, PDO::PARAM_STR);

    $stmt->execute();


    echo json_encode(array('success'=>true));

}catch (PDOException $e){
    echo json_encode(array('success'=>'False', 'error'=>'Error al Insertar la factura'.$e->getMessage()));
}
?>