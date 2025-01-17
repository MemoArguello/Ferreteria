<?php require "../../include/header.php" ?>
<?php require "../../backend/config/baseDeDatos.php" ?>
<?php

$usuario = $_SESSION['usuario'];
if (empty($usuario)) {
    header("location:../../index.php");
}
if ($_SESSION['id_cargo'] != 1){
    header("Location: ".INICIO."");
}
$sql = $conn->query("SELECT usuarios.*, cargo.descripcion as cargo 
                     FROM usuarios 
                     JOIN cargo ON cargo.id = usuarios.id_cargo
                     WHERE usuarios.estado = 1");
$sql->execute();

$usuariosTotal = $sql->fetchAll(PDO::FETCH_OBJ);
?>
<section id="content">
    <main>
        <div class="left">
            <nav class="nav">
                <ul class="breadcrumb">
                    <li>
                        <a class="active" href="./reporte_cuenta.php">Cuentas</a>
                    </li>
                </ul>
                <ul class="breadcrumb">
                    <li>
                        <a class="active" href="../configuracion/registrar_usuario.php">Registrar Cuenta</a>
                    </li>
                </ul>
                <ul class="breadcrumb">
                    <li>
                        <a class="active" href="../configuracion/informacion.php">Datos de la Empresa</a>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="table-data">
            <div class="container">
                <div class="titulo" align="center">
                    <h2>Cuentas Existentes</h2>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <table id="listado" class="table-striped table-bordered" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>Correo</th>
                                    <th>Usuario</th>
                                    <th>Cargo</th>
                                    <th>Contraseña</th>
                                    <th>Editar</th>
                                    <th>Eliminar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($usuariosTotal as $usuario) : ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td><?= $usuario->correo ?></td>
                                        <td><?= $usuario->usuario ?></td>
                                        <td><?= $usuario->cargo ?></td>
                                        <td>
                                            <a class="submitBotonPass" href="../configuracion/editar_contraseña.php?id=<?= $usuario->id_usuario ?>">
                                                <i class='bx bx-key'></i>
                                            </a>
                                        </td>
                                        <td>
                                            <a class="submitBotonEditar" href="../configuracion/editar_cuenta.php?id=<?= $usuario->id_usuario ?>">
                                                <i class='bx bx-edit'></i>
                                            </a>
                                        </td>
                                        <td>
                                            <form id="formEliminarUsuario_<?= $usuario->id_usuario ?>" action="../../Backend/cuenta/eliminar_cuenta.php" method="POST">
                                                <input type="hidden" name="id" value="<?= $usuario->id_usuario ?>">
                                                <button type="button" class="submitBotonEliminar" onclick="confirmarEliminarUsuario(<?= $usuario->id_usuario ?>)">
                                                    <i class='bx bx-trash'></i>
                                                </button>
                                            </form>
                                        </td>

                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
</section>
<?php require "../../include/footer.php"; ?>