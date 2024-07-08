<?php
include '../config/baseDeDatos.php';

if (!empty($_POST)) {
    $alert = '';
    if (empty($_POST['cedula']) || empty($_POST['nombre']) || empty($_POST['ruc'])){
        echo "<script>alert('Complete los datos');
        window.location.href='../../Frontend/cliente/formulario_cliente.php'</script>";
        exit;
    } else {
        $cedula = $_POST['cedula'];
        $nombre = $_POST['nombre'];
        $ruc = $_POST['ruc'];
        $editar = $_POST['editar'];
        $fechaActual = date("Y-m-d H:i:s");
        $evento = 'Registro de Cliente';
        $id_departamento = $_POST['id_departamento'];
        $id_ciudad = $_POST['id_ciudad'];

        try {
            if ($editar == "si") {
                $id_cliente = $_POST['id_cliente'];
                $query = "UPDATE cliente SET cedula=?, nombre=?, ruc=?, id_departamento=?, id_ciudad=? WHERE id_cliente=?";
                $stmt = $conn->prepare($query);
                $stmt->execute([$cedula, $nombre, $ruc, $id_departamento, $id_ciudad, $id_cliente]);

                echo "<script>alert('Se editó correctamente');
                window.location.href='../../Frontend/reportes/reporte_cliente.php'</script>";

            } else {
                $usuario = $_POST["id_usuario"];
                $query2 = "INSERT INTO cliente (cedula, nombre, ruc, id_departamento, id_ciudad) VALUES (?, ?, ?, ?, ?)";
                $stmt2 = $conn->prepare($query2);
                $stmt2->execute([$cedula, $nombre, $ruc, $id_departamento, $id_ciudad]);

                $query4 = "INSERT INTO auditoria (id_usuario, evento, fecha) VALUES (?, ?, ?)";
                $stmt4 = $conn->prepare($query4);
                $stmt4->execute([$usuario, $evento, $fechaActual]);

                echo "<script>alert('Registro Exitoso');
                window.location.href='../../Frontend/cliente/formulario_cliente.php'</script>";
            }
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
?>
