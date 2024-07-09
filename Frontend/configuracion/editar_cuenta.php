<?php
require "../../include/header.php";
require '../../Backend/config/baseDeDatos.php';

$usuario = $_SESSION['usuario'];
if (!isset($usuario)) {
    header("location:../../index.php");
}
$query = $conn->query("SELECT * FROM cargo");
$query->execute();

$resultado = $query->fetchAll(PDO::FETCH_OBJ);

$id_usuario = $_GET['id'];
$query2 = $conn->query("SELECT * FROM usuarios WHERE id_usuario = '$id_usuario'");
$query2->execute();

$resultado2 = $query2->fetch(PDO::FETCH_OBJ);

?>
    <section id="content">
        <main>
                <div class="left">
                    <nav class="nav">
                        <ul class="breadcrumb">
                            <li>
                                <a class="active" href="../reportes/reporte_cuenta.php">Cuentas</a>
                            </li>
                        </ul>
                        <ul class="breadcrumb">
                            <li>
                                <a class="active" href="./registrar_usuario.php">Registrar Cuenta</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            <div class="table-data">
                <div class="container">

                    <form action="../../Backend/cuenta/editar.php" class="formRecepcion" method="POST">
                        <h1 align="center">Registrar Usuario</h1>
                        <div class="row">
                            <div class="col-25">
                                <label for="fname">Correo Electronico</label>
                            </div>
                            <div class="col-75">
                                <input type="text" id="fname" name="correo" value='<?php echo $resultado2->correo  ?>'>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-25">
                                <label for="lname">Nombre de Usuario</label>
                            </div>
                            <div class="col-75">
                                <input type="text" id="lname" name="usuario" value='<?php echo $resultado2->usuario  ?>'>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-25">
                                <label for="country">Cargo</label>
                            </div>
                            <div class="col-75">
                                <select id="cargo" name="id_cargo" required>
                                    <option value="">Seleccione una opción</option> <!-- Opción en blanco -->
                                    <?php
                                    foreach ($resultado as $cargo) {
                                        $selected = ($cargo->id == $resultado2->id_cargo) ? 'selected' : '';
                                        echo "<option value='" . $cargo->id . "' $selected>" . $cargo->descripcion . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <input type="hidden" name="id_usuario" id="" value='<?php echo $resultado2->id_usuario ?>' readonly>
                            <input type="hidden" name="editar" id="" value='si' readonly>
                            <input type="submit" value="Guardar" class="boton2">
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </section>
<?php require "../../include/footer.php" ?>