<?php
include '../config/baseDeDatos.php';

if (!empty($_POST)) {
    $alert = '';
    if (empty($_POST['codigo'])) {
        echo "<script>alert('Todos los campos son obligatorios');
        window.location.href='../../Frontend/reportes/reporte_cuenta.php'</script>";
    } else {
        $usuario = $_POST['usuario'];
        $password = md5($_POST['codigo']);
        $cpassword = md5($_POST['ccodigo']);
        $editar = $_POST['editar'];

        if ($password == $cpassword) {
            try {
                // Preparar consulta para verificar si el usuario existe
                $query = $conn->prepare("SELECT * FROM usuarios WHERE usuario = :usuario");
                $query->bindParam(':usuario', $usuario);
                $query->execute();
                $usuarioExistente = $query->fetch(PDO::FETCH_ASSOC);

                if ($usuarioExistente) {
                    if ($editar == "si") {
                        $id_usuario = $_POST['id_usuario'];
                        // Actualizar contraseña
                        $query = $conn->prepare("UPDATE usuarios SET codigo = :password WHERE id_usuario = :id_usuario");
                        $query->bindParam(':password', $password);
                        $query->bindParam(':id_usuario', $id_usuario);
                        $result = $query->execute();

                        if ($result) {
                            echo "<script>alert('Contraseña actualizada correctamente');
                            window.location.href='../../Frontend/reportes/reporte_cuenta.php'</script>";
                        } else {
                            echo "<script>alert('No se pudo actualizar la contraseña');
                            window.location.href='../../Frontend/reportes/reporte_cuenta.php'</script>";
                        }
                    } else {
                        echo "<script>alert('Editar no está habilitado');
                        window.location.href='../../Frontend/reportes/reporte_cuenta.php'</script>";
                    }
                } else {
                    echo "<script>alert('El usuario no existe');
                    window.location.href='../../Frontend/reportes/reporte_cuenta.php'</script>";
                }
            } catch (PDOException $e) {
                echo "<script>alert('Error en la consulta: " . $e->getMessage() . "');
                window.location.href='../../Frontend/reportes/reporte_cuenta.php'</script>";
            }
        } else {
            echo "<script>alert('La contraseña no coincide, vuelva a intentarlo');
            window.location.href='../../Frontend/reportes/reporte_cuenta.php'</script>";
        }
    }
}
?>
