<?php require "../../include/header.php" ?>
<?php require "../../backend/config/baseDeDatos.php"?>
<?php


$usuario = $_SESSION['usuario'];
if (!isset($usuario)) {
    header("location:../../index.php");
}

try {
    $query = $conn->prepare("SELECT * FROM departamentos ORDER BY id_departamento");
    $query->execute();
    $resultado = $query->fetchAll(PDO::FETCH_ASSOC);

    $id_departamento = isset($_POST['id_departamento']) ? $_POST['id_departamento'] : '';

    $query2 = $conn->prepare("SELECT * FROM ciudades WHERE id_departamento = :id_departamento");
    $query2->bindParam(':id_departamento', $id_departamento);
    $query2->execute();
    $resultado2 = $query2->fetchAll(PDO::FETCH_ASSOC);

    // Obtener el ID del usuario para auditoría
    $consulta = $conn->prepare("SELECT id_usuario FROM usuarios WHERE usuario = :usuario");
    $consulta->bindParam(':usuario', $usuario);
    $consulta->execute();
    $resultado3 = $consulta->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
    <section id="content">
        <main>
                <div class="left">
                    <nav class="nav">
                        <ul class="breadcrumb">
                            <li>
                            <a class="active" href="../reportes/reporte_cliente.php">Clientes</a>
                            </li>
                        </ul>
                        <ul class="breadcrumb">
                            <li>
                                <a class="active" href="./formulario_cliente.php">Registrar</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            <div class="table-data">
                <div class="container">
                    <form action="../../Backend/cliente/guardar_cliente.php" class="formRecepcion" method="POST">
                        <h1 align="center">Registrar Cliente</h1>
                        <div class="row">
                            <div class="col-25">
                                <label for="fname">Numero de Cedula</label>
                            </div>
                            <div class="col-75">
                                <input type="text" id="fname" name="cedula" placeholder="" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-25">
                                <label for="lname">Nombres y Apellidos</label>
                            </div>
                            <div class="col-75">
                                <input type="text" id="lname" name="nombre" placeholder="" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-25">
                                <label for="lname">RUC</label>
                            </div>
                            <div class="col-75">
                                <input type="text" id="lname" name="ruc" placeholder="" required>
                            </div>
                        </div>
                        <div class="row">
                        <div class="col-25">
                            <label for="country">Departamento</label>
                        </div>
                        <div class="col-75">
                            <select id="departamento" name="id_departamento" onchange="getCiudades(this.value)" required>
                                <option value="">Seleccione una opción</option>
                                <?php
                                foreach ($resultado as $departamento) {
                                    echo "<option value='" . $departamento['id_departamento'] . "'>" . $departamento['nombre'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="country">Distrito</label>
                        </div>
                        <div class="col-75">
                            <select id="ciudad" name="id_ciudad" required>
                                <option value="">Seleccione una opción</option> <!-- Opción en blanco -->
                            </select>
                        </div>
                    </div>
                        <br>
                        <div class="row">
                        <input type="hidden" name="id_usuario" value='<?php echo $resultado3['id_usuario']; ?>' readonly>
                            <input type="hidden" name="editar" id="" value='no' readonly>
                            <input type="submit" value="Guardar" class="boton2">
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </section>
    <script>
    function getCiudades(idDepartamento) {
    // Realizar solicitud AJAX para obtener las ciudades del departamento seleccionado
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // Procesar la respuesta y actualizar el select de ciudades
            var ciudades = JSON.parse(this.responseText);
            var options = '<option value="">Seleccione una opción</option>'; // Opción en blanco por defecto
            for (var i = 0; i < ciudades.length; i++) {
                options += '<option value="' + ciudades[i].id_ciudad + '">' + ciudades[i].nombre + '</option>';
            }
            document.getElementById("ciudad").innerHTML = options;
        }
    };
    xhttp.open("GET", "./get_ciudades.php?id_departamento=" + idDepartamento, true);
    xhttp.send();
}
</script>
<?php require "../../include/footer.php" ?>