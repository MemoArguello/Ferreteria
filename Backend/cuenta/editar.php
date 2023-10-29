<?php
include '../../Backend/config/baseDeDatos.php';
if (empty($_POST['correo']) || empty($_POST['usuario']) || empty($_POST['id_cargo'])) {
    echo "<script>alert('Todos los campos son obligatorios');
    window.location.href='../../Frontend/reportes/reporte_cuenta.php'</script>";
}else{
        $cargo=$_POST['id_cargo'];
        $correo=$_POST['correo'];
        $usuario=$_POST['usuario'];
        $editar = $_POST['editar'];

        $conexiondb = conectardb();

            $sql="SELECT * FROM usuarios WHERE
            correo='$correo'";
            $result= mysqli_query($conexiondb, $sql);
            $editar = $_POST['editar'];
            if($editar  = "si"){
                    $id_usuario = $_POST['id_usuario'];
                    $sql="UPDATE usuarios SET correo='" . $correo . "', usuario='" . $usuario . "', id_cargo='" . $cargo ."' WHERE id_usuario=" . $id_usuario;
                    $result=mysqli_query($conexiondb ,$sql);
                    if($result){
                    echo "<script>alert('Se edito correctamente');
                    window.location.href='../../Frontend/reportes/reporte_cuenta.php'</script>";
                }else{
                    echo "<script>alert('No se edito correctamente');
                    window.location.href='../../Frontend/reportes/reporte_cuenta.php'</script>";
                }
            }else{
                echo "<script>alert('El correo ya existe');
                window.location.href='../../Frontend/reportes/reporte_cuenta.php'</script>";
            } 
        }
?>