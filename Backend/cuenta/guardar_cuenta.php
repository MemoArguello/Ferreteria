<?php
include '../config/baseDeDatos.php';

if (!empty($_POST)) {
    $alert = '';
    if (empty($_POST['correo']) || empty($_POST['usuario']) || empty($_POST['codigo']) || empty($_POST['ccodigo']) || empty($_POST['id_cargo'])) {
        echo "<script>alert('Todos los campos son obligatorios');
        window.location.href='../../Frontend/configuracion/registrar_usuario.php'</script>";
    } else {
        $cargo = $_POST['id_cargo'];
        $correo = $_POST['correo'];
        $usuario = $_POST['usuario'];
        $password = md5($_POST['codigo']);
        $cpassword = md5($_POST['ccodigo']);

        if ($password == $cpassword) {
            try {
                $stmt = $conn->prepare("SELECT * FROM usuarios WHERE correo=:correo");
                $stmt->bindParam(':correo', $correo);
                $stmt->execute();

                if ($stmt->rowCount() == 0) {
                    $stmt = $conn->prepare("INSERT INTO usuarios (correo, usuario, codigo, id_cargo) VALUES (:correo, :usuario, :password, :cargo)");
                    $stmt->bindParam(':correo', $correo);
                    $stmt->bindParam(':usuario', $usuario);
                    $stmt->bindParam(':password', $password);
                    $stmt->bindParam(':cargo', $cargo);
                    $stmt->execute();

                    echo "<script>alert('Usuario registrado');
                    window.location.href='../../Frontend/reportes/reporte_cuenta.php'</script>";
                } else {
                    echo "<script>alert('El correo ya existe');
                    window.location.href='../../Frontend/configuracion/registrar_usuario.php'</script>";
                }
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
                echo "<script>alert('Error al registrar usuario');
                window.location.href='../../Frontend/configuracion/registrar_usuario.php'</script>";
            }
        } else {
            echo "<script>alert('La contraseña no coincide, vuelva a intentarlo');
            window.location.href='../../Frontend/configuracion/registrar_usuario.php'</script>";
        }
    }
}
?>