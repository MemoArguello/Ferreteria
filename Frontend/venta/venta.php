<?php require "../../include/header.php" ?>
<?php require "../../backend/config/baseDeDatos.php" ?>
<?php


$usuario = $_SESSION['usuario'];
if (!isset($usuario)) {
    header("location:../../index.php");
    exit();
}

// Consulta para obtener categorías
$query = $conn->prepare("SELECT * FROM categorias");
$query->execute();
$resultado2 = $query->fetchAll(PDO::FETCH_ASSOC);

// Consulta para obtener información del usuario
$consulta = $conn->prepare("SELECT id_usuario FROM usuarios WHERE usuario = :usuario");
$consulta->bindParam(':usuario', $usuario);
$consulta->execute();
$resultado = $consulta->fetch(PDO::FETCH_ASSOC);
?>
<style>


/* Estilos para las columnas del formulario */
.row {
    display: flex;
    flex-wrap: wrap;
    margin-bottom: 15px;
}

.col-25, .col-75 {
    padding: 0 10px;
    box-sizing: border-box;
}

.col-25 {
    flex: 25%;
    max-width: 25%;
}

.col-75 {
    flex: 75%;
    max-width: 75%;
}

/* Botones */
.boton, .boton2 {
    background-color: #0400ff;
    color: white;
    border: none;
    padding: 10px 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin-top: 10px;
    cursor: pointer;
    border-radius: 5px;
}


/* Tabla responsiva */
.table-responsive {
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
    margin-bottom: 20px;
}

#tabla_productos {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}

#tabla_productos th, #tabla_productos td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
}

#tabla_productos th {
    background-color: #f2f2f2;
    color: #333;
}

#tabla_productos tbody tr:nth-child(even) {
    background-color: #f9f9f9;
}

/* Estilos para pantallas pequeñas */
@media screen and (max-width: 600px) {
    .col-25, .col-75 {
        flex: 100%;
        max-width: 100%;
    }

    .col-25 {
        margin-bottom: 10px;
    }

    .boton, .boton2 {
        width: 100%;
        padding: 12px 0;
    }
}

</style>
<section id="content">
    <main>
        <div class="left">
            <nav class="nav">
                <ul class="breadcrumb">
                    <li>
                        <a class="active" href="./venta.php">Venta</a>
                    </li>
                </ul>
                <ul class="breadcrumb">
                    <li>
                        <a class="active" href="../reportes/reporte_venta.php">Listado</a>
                    </li>
                </ul>
                <ul class="breadcrumb">
                    <li>
                        <a class="active" href="../reportes/reporte_factura.php">Facturas</a>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="table-data">
            <div class="container">
                <form action="procesar_factura.php" method="post" class="form_vent">
                    <div class="left">
                        <h1>Generar Factura</h1>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="cliente">Ingrese Cedula del Cliente:</label>
                        </div>
                        <div class="col-75">
                            <input type="text" id="fname" name="cedula" placeholder="Cedula" required>
                            <button class="boton" onclick="consultarCliente();">Buscar</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="tipo">Cliente:</label>
                        </div>
                        <div class="col-75">
                            <input type="text" id="nombreCliente" readonly placeholder="Nombre del Cliente">
                            <button class="boton" onclick="consultarCliente();">Buscar</button>
                        </div>
                    </div>
                    <div class="left">
                        <h3>Formulario de Productos:</h3>
                    </div>
                    <br>
                    <br>
                    <div class="row">
                        <div class="col-25">
                            <label for="categoria">Categoría:</label>
                        </div>
                        <div class="col-75">
                            <select name="categoria" id="categoria" onchange="cargarProductos(this.value)" required>
                                <option value="">Seleccione una opción</option>
                                <?php
                                foreach ($resultado2 as $categoria) {
                                    echo "<option value='" . $categoria['id_categoria'] . "'>" . $categoria['descripcion'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-25">
                            <label for="producto">Producto:</label>
                        </div>
                        <div class="col-75">
                            <select id="producto" name="id_producto" required>
                                <option value="">Seleccione una opción</option> <!-- Opción en blanco -->
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-25">
                            <label for="cantidad">Cantidad:</label>
                        </div>
                        <div class="col-75">
                            <input type="number" name="cantidad" min="1" required>
                        </div>
                    </div>
                    <div class="row">
                        <input type="hidden" name="id_usuario" value='<?= $resultado['id_usuario'] ?>' readonly>
                        <br>
                        <input type="submit" class="boton2" value="Vender">
                    </div>
                </form>
            </div>
        </div>
    </main>
</section>

<script>
function cargarProductos(id_categoria) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var productos = JSON.parse(this.responseText);
            var options = '<option value="">Seleccione una opción</option>'; // Opción en blanco por defecto
            for (var i = 0; i < productos.length; i++) {
                options += '<option value="' + productos[i].id_producto + '">' + productos[i].nombre_producto + '</option>';
            }
            document.getElementById("producto").innerHTML = options;
        }
    };
    xhttp.open("GET", "./cargar_productos.php?id_categoria=" + id_categoria, true);
    xhttp.send();
}
</script>

<?php require "../../include/footer.php"; ?>