<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica que los campos necesarios estén presentes
    if (isset($_POST['usuario']) && isset($_POST['codigo'])) {
        // Obtiene los datos del formulario
        $usuario = $_POST['usuario'];
        $codigo = md5($_POST['codigo']);

        // Conexión a la base de datos
        include '../config/baseDeDatos.php';

        // Consulta segura con PDO
        $consulta = $conn->prepare("SELECT * FROM usuarios WHERE usuario = :usuario AND codigo = :codigo");
        $consulta->execute([':usuario' => $usuario, ':codigo' => $codigo]);

        // Obtener el resultado
        $filas = $consulta->fetch(PDO::FETCH_ASSOC);

        // Verificar si se encontró un usuario
        if ($filas) {
            // Asignar variables de sesión
            $_SESSION['usuario'] = $filas['usuario'];
            $_SESSION['id_cargo'] = $filas['id_cargo'];
            $_SESSION['id_usuario'] = $filas['id_usuario'];

            // Redirigir según el id_cargo del usuario
            if ($filas['id_cargo'] == 1 || $filas['id_cargo'] == 2) {
                header("Location: ../../Frontend/inicio/inicio.php");
                exit;
            } else {
                echo "<script>alert('No tiene permisos suficientes');
                      window.location.href='../../index.php';</script>";
                exit;
            }
        } else {
            echo "<script>alert('No existe cuenta');
                  window.location.href='../../index.php';</script>";
            exit;
        }
    } else {
        echo "<script>alert('Por favor, rellene todos los campos');
              window.location.href='../../index.php';</script>";
        exit;
    }
} else {
    header("Location: ../../index.php");
    exit;
}
?>
