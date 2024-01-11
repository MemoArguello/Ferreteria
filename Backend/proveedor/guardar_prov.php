<?php
include '../config/baseDeDatos.php';
if (!empty($_POST)) {
    $alert = '';
if (empty($_POST['nombre_prov']) || empty($_POST['ruc']) || empty($_POST['telefono'])){
    echo "<script>alert('Complete los datos');
    window.location.href='../../Frontend/proveedores/agg_proveedor.php'</script>";
    exit; 
}else{
        $nombre_prov = $_POST['nombre_prov'];
        $ruc = $_POST['ruc'];
        $telefono = $_POST['telefono'];
        $editar = $_POST['editar'];

        $conexiondb = conectardb();

        if ($editar == "si") {
            $id_proveedor = $_POST['id_proveedor'];
            $query = "UPDATE proveedores SET nombre_prov='" . $nombre_prov . "', ruc='" . $ruc . "', telefono ='" . $telefono . "' WHERE id_proveedor='" . $id_proveedor . "'";
            
            $respuesta = mysqli_query($conexiondb, $query);

            if ($respuesta) {
                    echo "<script>alert('Se editó correctamente');
                    window.location.href='../../Frontend/reportes/reporte_prov.php'</script>";
                } else {
                    echo "<script>alert('Registro Fallido');
                    window.location.href='../../Frontend/reportes/reporte_prov.php'</script>";
                }

        } else {
            $id_departamento = $_POST['id_departamento'];
            $id_ciudad = $_POST['id_ciudad'];
            $query2 = "INSERT INTO proveedores (nombre_prov, ruc, telefono, departamento, distrito) VALUES 
                ('$nombre_prov', '$ruc', '$telefono', '$id_departamento', '$id_ciudad')";

            $respuesta2 = mysqli_query($conexiondb, $query2);

            if ($respuesta2) {
                    echo "<script>alert('Registro Exitoso');
                    window.location.href='../../Frontend/reportes/reporte_prov.php'</script>";
                } else {
                    echo "<script>alert('Registro Exitoso');
                    window.location.href='../../Frontend/reportes/reporte_prov.php'</script>";
                }
        }
        mysqli_close($conexiondb);
    }
}
?>