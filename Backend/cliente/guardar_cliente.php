<?php

include '../config/baseDeDatos.php';
if (!empty($_POST)) {
    $alert = '';
if (empty($_POST['cedula']) || empty($_POST['nombre']) || empty($_POST['apellido']) || empty($_POST['ruc']) || empty($_POST['id_departamento']) || empty($_POST['id_ciudad'])){
    echo "<script>alert('Complete los datos');
    window.location.href='../../Frontend/cliente/formulario_cliente.php'</script>";
    exit;
}else{
        $cedula = $_POST['cedula'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $ruc = $_POST['ruc'];
        $id_departamento = $_POST['id_departamento'];
        $id_ciudad = $_POST['id_ciudad'];
        $editar = $_POST['editar'];

        $conexiondb = conectardb();

        if ($editar == "si") {
            $id_alumno = $_POST['id_alumno'];
            $query = "UPDATE persona SET cedula='" . $cedula . "', nombre='" . $nombre . "',fecha_nacimiento='" . $fecha . "',genero='" . $genero . "', numero ='" . $numero . "' WHERE id_alumno='" . $id_alumno . "'";
            
            $respuesta = mysqli_query($conexiondb, $query);

            if ($respuesta) {
                    echo "<script>alert('Registro Exitoso');
                                        window.location.href='listar_alumno.php'</script>";
                } else {
                    echo "<script>alert('Registro Fallido');
                                            window.location.href='listar_alumno.php'</script>";
                }

        } else {
            $query2 = "INSERT INTO cliente (cedula, nombre, apellido, ruc, id_departamento, id_ciudad) VALUES 
                ('$cedula', '$nombre', '$apellido', '$ruc', '$id_departamento', '$id_ciudad')";

            $respuesta2 = mysqli_query($conexiondb, $query2);

            if ($respuesta2) {
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