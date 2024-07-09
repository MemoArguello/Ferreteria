<?php
require '../../Backend/config/baseDeDatos.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['editar']) && $_POST['editar'] == 'si') {
    $id_usuario = $_POST['id_usuario'];
    $correo = $_POST['correo'];
    $usuario = $_POST['usuario'];
    $id_cargo = $_POST['id_cargo'];

    try {
        // Verificar si el correo ya existe para otro usuario
        $query = $conn->prepare("SELECT id_usuario FROM usuarios WHERE correo = :correo AND id_usuario != :id_usuario");
        $query->bindParam(':correo', $correo);
        $query->bindParam(':id_usuario', $id_usuario);
        $query->execute();

        if ($query->rowCount() > 0) {
            echo "<script>alert('El correo electrónico ya está en uso.'); window.history.back();</script>";
            exit;
        }

        // Si el correo no existe, proceder con la actualización
        $query = $conn->prepare("UPDATE usuarios SET correo = :correo, usuario = :usuario, id_cargo = :id_cargo WHERE id_usuario = :id_usuario");
        $query->bindParam(':correo', $correo);
        $query->bindParam(':usuario', $usuario);
        $query->bindParam(':id_cargo', $id_cargo);
        $query->bindParam(':id_usuario', $id_usuario);

        if ($query->execute()) {
            echo "<script>alert('Usuario actualizado correctamente'); window.location.href='../../Frontend/reportes/reporte_cuenta.php'</script>";
        } else {
            echo "<script>alert('No se pudo actualizar el usuario'); window.location.href='../../Frontend/reportes/reporte_cuenta.php'</script>";
        }
    } catch (PDOException $e) {
        echo "<script>alert('Error: " . $e->getMessage() . "'); window.location.href='../../Frontend/reportes/reporte_cuenta.php'</script>";
    }
} else {
    header("location:../../Frontend/reportes/reporte_cuenta.php");
}
?>
