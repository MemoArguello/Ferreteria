<?php
session_start();

if (isset($_SESSION['usuario'])) {
    header("Location: inicio/inicio.php"); 
    exit(); 
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../Frontend/CSS/login.css">
</head>

<body>
    <div class="contenedor-formulario contenedor">
        <form action="../Backend/validacion/validar.php" method="POST" class="formulario">
            <div class="texto-formulario">
                <h2>SISTEMA FERRETERIA</h2>
                <p>Iniciar Sesión</p>
            </div>
            <div class="inputContainer">
                <input type="text" class="input" placeholder="" name="usuario">
                <label for="" class="label">Usuario</label>
            </div>
            <div class="inputContainer">
                <input type="password" class="input" placeholder="" name="codigo">
                <label for="" class="label">Contraseña</label>
            </div>
            <input type="submit" class="submitBtn" value="INGRESAR">
        </form>
    </div>
</body>

</html>