<?php
include '../config/baseDeDatos.php';
if (!empty($_POST)) {
    $alert = '';
if (empty($_POST['cedula']) || empty($_POST['nombre']) || empty($_POST['ruc'])){
    echo "<script>alert('Complete los datos');
    window.location.href='../../Frontend/cliente/formulario_cliente.php'</script>";
    exit;
}else{
        $cedula = $_POST['cedula'];
        $nombre = $_POST['nombre'];
        $ruc = $_POST['ruc'];
        $editar = $_POST['editar'];
        $fechaActual = date("Y-m-d H:i:s");
        $evento = 'Registro de Cliente';
        $id_departamento = $_POST['id_departamento'];
        $id_ciudad = $_POST['id_ciudad'];
        $conexiondb = conectardb();

        if ($editar == "si") {
            $id_cliente = $_POST['id_cliente'];
            $query = "UPDATE cliente SET cedula='" . $cedula . "', nombre='" . $nombre . "', ruc='" . $ruc . "', id_departamento='" . $id_departamento."', id_ciudad='" . $id_ciudad ."' WHERE id_cliente='" . $id_cliente . "'";
            
            $respuesta = mysqli_query($conexiondb, $query);

            if ($respuesta) {
                    echo "<script>alert('Se editó correctamente');
                    window.location.href='../../Frontend/reportes/reporte_cliente.php'</script>";
                } else {
                    echo "<script>alert('Registro Fallido');
                    window.location.href='../../Frontend/reportes/reporte_cliente.php'</script>";
                }

        } else {
            $id_departamento = $_POST['id_departamento'];
            $id_ciudad = $_POST['id_ciudad'];
            $usuario = $_POST["id_usuario"];

            $query2 = "INSERT INTO cliente (cedula, nombre, ruc, id_departamento, id_ciudad) VALUES 
                ('$cedula', '$nombre', '$ruc', '$id_departamento', '$id_ciudad')";

            $respuesta2 = mysqli_query($conexiondb, $query2);

            $query4 = "INSERT INTO auditoria (id_usuario, evento, fecha) VALUES 
                ('$usuario', '$evento', '$fechaActual')";
            $respuesta4 = mysqli_query($conexiondb, $query4);
            if ($respuesta2 and $respuesta4) {
                    echo "<script>alert('Registro Exitoso');
                                        window.location.href='../../Frontend/cliente/formulario_cliente.php'</script>";
                } else {
                    echo "<script>alert('Registro Exitoso');
                    window.location.href='../../Frontend/cliente/formulario_cliente.php'</script>";
                }
        }
        mysqli_close($conexiondb);
    }
}
?>