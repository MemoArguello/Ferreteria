<?php
include '../../Backend/config/baseDeDatos.php';
try {
    $cedula = $_POST["ciCliente"];
    $estado = 1;  // Estado que estás buscando, en este caso, 1

    $stmt = $conn->prepare("SELECT * FROM cliente WHERE cedula = :cedula AND estado = :estado");
    $stmt->bindParam(':cedula', $cedula, PDO::PARAM_INT);
    $stmt->bindParam(':estado', $estado, PDO::PARAM_INT);
    $stmt->execute();

    $cliente = $stmt->fetch(PDO::FETCH_ASSOC);

    if($cliente) {
        $respuesta = array(
            'nombre_cliente' => $cliente['nombre'],
            'id_cliente' => $cliente['id_cliente']
        );
        echo json_encode($respuesta);
    } else {
        echo json_encode(array('error' => 'Cliente no encontrado'));
    }
} catch (PDOException $e) {
    echo json_encode(array('error' => 'Error de conexión ' . $e->getMessage()));
}
?>
