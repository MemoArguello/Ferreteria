<?php
$usuario=$_POST['usuario'];
$codigo=md5($_POST['codigo']);
session_start();
$_SESSION['usuario']=$usuario;

include '../config/baseDeDatos.php';

$conexiondb = conectardb();

$consulta= "SELECT * FROM usuarios where usuario ='$usuario' and codigo='$codigo'";
$resultado=mysqli_query($conexiondb,$consulta);

$filas=mysqli_fetch_array($resultado);

if($codigo == isset($filas['codigo'])){
    if(($filas['id_cargo'])==1){ //administrador
        header("location:../../Frontend/inicio/inicio.php");
    
    }else if(($filas['id_cargo'])==2){ //Recepcionista
        header("location:../calendario/index.php");
    }else{
        echo "<script>alert('no existe cuenta');
        window.location.href='../../index.php'</script>";
    }
}else{
    echo "<script>alert('no existe cuenta');
    window.location.href='../../index.php'</script>";
}


mysqli_free_result($resultado);
?>