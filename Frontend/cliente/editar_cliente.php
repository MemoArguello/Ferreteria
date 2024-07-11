<?php
require "../../include/header.php";
include '../../Backend/config/baseDeDatos.php';

$usuario = $_SESSION['usuario'];
if (!isset($usuario)) {
    header("location:../../index.php");
}
$query = $conn->query("SELECT * FROM departamentos");
$query->execute();

$resultado = $query->fetchAll(PDO::FETCH_OBJ);

$id_cliente = $_GET['id'];
$query3 = $conn->query("SELECT cliente.id_cliente, cliente.cedula, cliente.nombre, cliente.ruc, cliente.id_departamento, cliente.id_ciudad, departamentos.nombre as nombre_departamento, ciudades.nombre as nombre_ciudad FROM cliente JOIN departamentos 
            ON departamentos.id_departamento = cliente.id_departamento JOIN ciudades ON ciudades.id_ciudad = cliente.id_ciudad WHERE id_cliente=" . $id_cliente);
$query3->execute();

$resultado3 = $query3->fetch(PDO::FETCH_OBJ);

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
                            <input type="text" id="fname" name="cedula" placeholder="" required value='<?php echo $resultado3->cedula; ?>'>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="lname">Nombres</label>
                        </div>
                        <div class="col-75">
                            <input type="text" id="lname" name="nombre" placeholder="" required value='<?php echo $resultado3->nombre; ?>'>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="lname">RUC</label>
                        </div>
                        <div class="col-75">
                            <input type="text" id="lname" name="ruc" placeholder="" required value='<?php echo $resultado3->ruc; ?>'>
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
                                foreach ($resultado as $depar) {
                                    $selected = ($depar->id_departamento == $resultado3->id_departamento) ? 'selected' : '';
                                    echo "<option value='" . $depar->id_departamento . "' $selected>" . $depar->nombre . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="country">Ciudad</label>
                        </div>
                        <div class="col-75">
                            <select id="ciudad" name="id_ciudad" required>
                                <option value="">Seleccione una opción</option> <!-- Opción en blanco -->
                                <?php
                                $query4 = $conn->prepare("SELECT * FROM ciudades WHERE id_departamento = :id_departamento");
                                $query4->bindParam(':id_departamento', $resultado3->id_departamento);
                                $query4->execute();
                                $resultado4 = $query4->fetchAll(PDO::FETCH_OBJ);

                                foreach ($resultado4 as $ciudad) {
                                    $selected = ($ciudad->id_ciudad == $resultado3->id_ciudad) ? 'selected' : '';
                                    echo "<option value='" . $ciudad->id_ciudad . "' $selected>" . $ciudad->nombre . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <br>
                    <div class="row">
                        <input type="hidden" name="id_cliente" id="" value='<?php echo $resultado3->id_cliente; ?>' readonly>
                        <input type="hidden" name="editar" id="" value='si' readonly>
                        <input type="submit" value="Guardar" class="boton2">
                    </div>
                </form>
            </div>
        </div>
    </main>
</section>
<script>
    function getCiudades(id_departamento) {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'get_ciudades.php?id_departamento=' + id_departamento, true);
        xhr.onload = function () {
            if (xhr.status === 200) {
                var ciudades = JSON.parse(xhr.responseText);
                var ciudadSelect = document.getElementById('ciudad');
                ciudadSelect.innerHTML = '<option value="">Seleccione una opción</option>';
                ciudades.forEach(function (ciudad) {
                    ciudadSelect.innerHTML += '<option value="' + ciudad.id_ciudad + '">' + ciudad.nombre + '</option>';
                });
            }
        };
        xhr.send();
    }
</script>
<?php require "../../include/footer.php"; ?>
