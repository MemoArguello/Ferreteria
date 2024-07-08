<?php
include '../config/baseDeDatos.php';

if (!empty($_POST)) {
    $alert = '';

    if (empty($_POST['nombre_prov']) || empty($_POST['ruc']) || empty($_POST['telefono'])) {
        echo "<script>alert('Complete los datos');
        window.location.href='../../Frontend/proveedores/agg_proveedor.php'</script>";
        exit;
    } else {
        $nombre_prov = $_POST['nombre_prov'];
        $ruc = $_POST['ruc'];
        $telefono = $_POST['telefono'];
        $editar = $_POST['editar'];
        $id_usuario = $_POST["id_usuario"];
        $fechaActual = date("Y-m-d H:i:s");
        $evento = 'Registro de Proveedor';

        try {
            global $conn;

            $conn->beginTransaction(); // Inicia una transacción

            if ($editar == "si") {
                $id_proveedor = $_POST['id_proveedor'];
                $query = "UPDATE proveedores SET nombre_prov=:nombre_prov, ruc=:ruc, telefono=:telefono WHERE id_proveedor=:id_proveedor";
                
                $stmt = $conn->prepare($query);
                $stmt->bindParam(':nombre_prov', $nombre_prov);
                $stmt->bindParam(':ruc', $ruc);
                $stmt->bindParam(':telefono', $telefono);
                $stmt->bindParam(':id_proveedor', $id_proveedor);
                $stmt->execute();

                echo "<script>alert('Se editó correctamente');
                window.location.href='../../Frontend/reportes/reporte_prov.php'</script>";

            } else {
                $id_departamento = $_POST['id_departamento'];
                $id_ciudad = $_POST['id_ciudad'];
                $query2 = "INSERT INTO proveedores (nombre_prov, ruc, telefono, departamento, distrito) VALUES 
                    (:nombre_prov, :ruc, :telefono, :id_departamento, :id_ciudad)";
                
                $stmt = $conn->prepare($query2);
                $stmt->bindParam(':nombre_prov', $nombre_prov);
                $stmt->bindParam(':ruc', $ruc);
                $stmt->bindParam(':telefono', $telefono);
                $stmt->bindParam(':id_departamento', $id_departamento);
                $stmt->bindParam(':id_ciudad', $id_ciudad);
                $stmt->execute();

                $id_proveedor = $conn->lastInsertId(); // Obtener el ID del proveedor insertado

                $query3 = "INSERT INTO auditoria (id_usuario, evento, fecha) VALUES 
                    (:id_usuario, :evento, :fechaActual)";
                
                $stmt = $conn->prepare($query3);
                $stmt->bindParam(':id_usuario', $id_usuario);
                $stmt->bindParam(':evento', $evento);
                $stmt->bindParam(':fechaActual', $fechaActual);
                $stmt->execute();

                $conn->commit(); // Confirma la transacción

                echo "<script>alert('Registro Exitoso');
                window.location.href='../../Frontend/reportes/reporte_prov.php'</script>";
            }
        } catch (PDOException $e) {
            $conn->rollback(); // Revierte la transacción si hay errores
            echo "Error: " . $e->getMessage();
        } finally {
            $conn = null; // Cierra la conexión
        }
    }
}
?>
