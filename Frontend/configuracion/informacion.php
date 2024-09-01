<?php require "../../include/header.php" ?>
<?php require "../../backend/config/baseDeDatos.php" ?>
<?php

$usuario = $_SESSION['usuario'];
if (!isset($usuario)) {
    header("location:../../index.php");
}

$query = $conn->query("SELECT * FROM datos_empresa");
$query->execute();
$resultado = $query->fetch(PDO::FETCH_OBJ);
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
                <ul class="breadcrumb">
                    <li>
                        <a class="active" href="../configuracion/informacion.php">Datos de la Empresa</a>
                    </li>
                </ul>
            </nav>
        </div>
        </div>
        <div class="table-data">
            <div class="container">
                <form action="../../Backend/cuenta/guardar_informacion.php" class="formRecepcion" method="POST" enctype="multipart/form-data">
                    <h1 align="center">Actualizar Datos de la Empresa</h1>
                    <div class="row">
                        <div class="col-25">
                            <label for="fname">Nombre de la Empresa</label>
                        </div>
                        <div class="col-75">
                            <input type="text" id="fname" name="nombre_empresa" required value='<?php echo $resultado->nombre_empresa ?>'">
                        </div>
                    </div>
                    <div class=" row">
                            <div class="col-25">
                                <label for="fname">Imagen Actual</label>
                            </div>
                            <div class="col-75">
                                <img src="../../Backend/cuenta/images/<?php echo $resultado->imagen_url; ?>" alt="Imagen Actual" width="100">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-25">
                                <label for="fname">Actualizar Imagen de la Empresa</label>
                            </div>
                            <div class="col-75">
                                <input type="file" name="imagen_url" id="form2Example1" class="form-control" />
                            </div>
                        </div>

                        <div class="row">
                            <input type="submit" value="Guardar" class="boton2">
                            <input type="hidden" name="id_datos" value="<?=$resultado->id_datos?>">
                            <input type="hidden" name="imagen_actual" value="<?=$resultado->imagen_url?>">
                        </div>
                </form>
            </div>

        </div>
    </main>
</section>
<?php require "../../include/footer.php" ?>