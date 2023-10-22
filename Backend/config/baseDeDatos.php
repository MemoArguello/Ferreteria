<?php
function conectardb() {
    $servidor = 'localhost';
    $usuario = 'root';
    $contraseña = '';
    $db = 'ferreteria';

    // Establecer la conexión
    $conexion = mysqli_connect($servidor, $usuario, $contraseña, $db);

    // Verificar si la conexión fue exitosa
    if (!$conexion) {
        die('Error de conexión: ' . mysqli_connect_error());
    }

    // Configurar el juego de caracteres de la conexión
    mysqli_set_charset($conexion, 'utf8');

    return $conexion;
}

// Ejemplo de uso
$conexion = conectardb();

// Realizar operaciones con la base de datos...

// Cerrar la conexión
mysqli_close($conexion);
?>