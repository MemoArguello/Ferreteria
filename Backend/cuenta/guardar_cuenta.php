<?php
include '../config/baseDeDatos.php';
if (!empty($_POST)) {
    $alert = '';
    if (empty($_POST['correo']) || empty($_POST['usuario']) || empty($_POST['codigo']) || empty($_POST['ccodigo']) || empty($_POST['id_cargo']) ) {
            echo "<script>alert('Todos los campos son obligatorios');
            window.location.href='../../Frontend/configuracion/registrar_usuario.php'</script>";
        }else{
        $cargo=$_POST['id_cargo'];
        $correo=$_POST['correo'];
        $usuario=$_POST['usuario'];
        $password=md5($_POST['codigo']);
        $cpassword=md5($_POST['ccodigo']);

        $conexiondb = conectardb();

        if($password==$cpassword){
            $sql="SELECT * FROM usuarios WHERE
            correo='$correo'";
            $result= mysqli_query($conexiondb, $sql);
            if(!$result->num_rows>0){
                    $sql="INSERT INTO usuarios (correo, usuario, codigo, id_cargo) VALUES 
                    ('$correo', '$usuario', '$password','$cargo')";
                $result=mysqli_query($conexiondb ,$sql);
    
                if($result){
                    echo "<script>alert('Usuario registrado');
                   window.location.href='../../Frontend/reportes/reporte_cuenta.php'</script>";
                }else{
                    echo "<script>alert('Usuario no registrado');
                    window.location.href='../../Frontend/configuracion/registrar_usuario.php'</script>";
                }
            }else{
                echo "<script>alert('El correo ya existe');
                window.location.href='../../Frontend/configuracion/registrar_usuario.php'</script>";
            }
        }else{
            echo "<script>alert('La contraseña no coincide, vuelva a intentarlo');
            window.location.href='../../Frontend/configuracion/registrar_usuario.php'</script>";
        }
        mysqli_close($conexiondb);
        }
    }
?>