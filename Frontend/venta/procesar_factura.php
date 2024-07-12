<?php
include '../../Backend/config/baseDeDatos.php';
try{
    $id_cliente = $_POST["id_cliente"];
    $stmt = $conn->prepare("INSERT INTO factura_cabecera (cliente) VALUES (:cliente)");
    $stmt->bindParam(':cliente',$id_cliente, PDO::PARAM_INT);
    $stmt->execute();

    //valor del ultimo id generado
    $factura_id = $conn->lastInsertId();

    echo json_encode(array('success'=>true,'id_factura'=>$factura_id));

}catch (PDOException $e){
    echo json_encode(array('error'=>'Error al ingresar la factura'.$e->getMessage()));
}
?>