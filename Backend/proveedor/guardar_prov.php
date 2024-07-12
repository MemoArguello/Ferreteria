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
        $id_departamento = $_POST["id_departamento"];
        $id_ciudad = $_POST["id_ciudad"];
        $fechaActual = date("Y-m-d H:i:s");
        $evento = 'Edición de Proveedor';

        try {
            if ($editar == "si") {
                $id_proveedor = $_POST["id_proveedor"];
                $conn->beginTransaction(); // Inicia una transacción

                $query = "UPDATE proveedores 
                        SET nombre_prov=:nombre_prov, ruc=:ruc, telefono=:telefono, 
                            departamento=:id_departamento, distrito=:id_ciudad 
                        WHERE id_proveedor=:id_proveedor";
                
                $stmt = $conn->prepare($query);
                $stmt->bindParam(':nombre_prov', $nombre_prov);
                $stmt->bindParam(':ruc', $ruc);
                $stmt->bindParam(':telefono', $telefono);
                $stmt->bindParam(':id_departamento', $id_departamento);
                $stmt->bindParam(':id_ciudad', $id_ciudad);
                $stmt->bindParam(':id_proveedor', $id_proveedor);
                $stmt->execute();

                $conn->commit(); // Confirma la transacción

                echo "<script>alert('Se editó correctamente');
                window.location.href='../../Frontend/reportes/reporte_prov.php'</script>";
            }else{
                $query2 = $conn->prepare("INSERT INTO proveedores (nombre_prov, ruc, telefono, departamento, distrito) VALUES (:nombre_prov, :ruc, :telefono, :departamento, :distrito)");
                $respuesta2 = $query2->execute([
                ":nombre_prov" => $nombre_prov,
                ":ruc" => $ruc,
                ":telefono" => $telefono,
                ":departamento" => $id_departamento,
                ":distrito" => $id_ciudad,
            ]);
            echo "<script>alert('Se Registro correctamente');
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