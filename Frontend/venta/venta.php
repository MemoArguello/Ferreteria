<?php require "../../include/header.php" ?>
<?php require "../../backend/config/baseDeDatos.php" ?>
<?php


$usuario = $_SESSION['usuario'];
if (!isset($usuario)) {
    header("location:../../index.php");
    exit();
}


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
                            <label for="codigo_factura">Código de factura:</label>
                        </div>
                        <div class="col-75">
                            <input type="text" name="codigo_factura" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="cliente">Cliente:</label>
                        </div>
                        <div class="col-75">
                            <select name="cliente" required>
                                <option value="">Seleccione una opción</option>
                                <?php
                                // Ejecutar la consulta SQL
                                $result = $conn->query("SELECT id_cliente, nombre FROM cliente");

                                // Verificar si hay filas devueltas
                                if ($result->rowCount() > 0) {
                                    // Iterar sobre cada fila y mostrar opciones
                                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                        // Mostrar una opción por cada cliente
                                        echo "<option value='{$row['id_cliente']}'>{$row['nombre']}</option>";
                                    }
                                } else {
                                    // Si no hay resultados
                                    echo "<option value=''>No hay clientes disponibles</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="tipo">Tipo:</label>
                        </div>
                        <div class="col-75">
                            <select name="tipo" required>
                                <option value="">Seleccione una opción</option>
                                <option value="Productos">Productos</option>
                                <option value="Servicios">Servicios</option>
                            </select>
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
                                // Ejecutar la consulta SQL
                                $result = $conn->query("SELECT * FROM categorias");

                                // Verificar si hay filas devueltas
                                if ($result->rowCount() > 0) {
                                    // Iterar sobre cada fila y mostrar opciones
                                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                        // Mostrar una opción por cada cliente
                                        echo "<option value='{$row['id_categoria']}'>{$row['descripcion']}</option>";
                                    }
                                } else {
                                    // Si no hay resultados
                                    echo "<option value=''>No hay datos disponibles</option>";
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
                            <select name="producto[]" id="producto" required>
                                <option value="" disabled selected>Selecciona primero la categoría</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="cantidad">Cantidad:</label>
                        </div>
                        <div class="col-75">
                            <input type="number" name="cantidad[]" min="1" required>
                        </div>
                    </div>
                    <div class="row">
                        <input type="button" class="boton2" value="Agregar" onclick="agregarProducto()">
                    </div>
                    <br>
                    <br>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Cantidad</th>
                                    <th>Producto</th>
                                    <th>Costo</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody id="tabla_productos">
                                <!-- Aquí se mostrarán los productos seleccionados -->
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <input type="hidden" name="id_usuario" value='<?php echo $idUsuario; ?>' readonly>
                        <br>
                        <input type="submit" class="boton2" value="Vender">
                    </div>
                </form>
            </div>
        </div>
    </main>
    <script>
        function cargarProductos(idCategoria) {
            $.ajax({
                url: 'cargar_productos.php',
                method: 'GET',
                data: {
                    id_categoria: idCategoria
                },
                success: function(data) {
                    $('#producto').html(data);
                }
            });
        }

        function agregarProducto() {
            var productoSelect = document.getElementsByName('producto[]')[0];
            var cantidadInput = document.getElementsByName('cantidad[]')[0];

            var productoId = productoSelect.value;
            var productoNombre = productoSelect.options[productoSelect.selectedIndex].text;
            var cantidad = cantidadInput.value;

            cargarCostoProducto(productoId, cantidad, productoNombre);
        }

        function cargarCostoProducto(idProducto, cantidad, nombreProducto) {
            $.ajax({
                url: 'obtener_costo_producto.php',
                method: 'GET',
                data: {
                    productoId: idProducto
                },
                success: function(data) {
                    var costo = parseFloat(data);
                    if (!isNaN(costo)) {
                        var total = cantidad * costo;
                        var newRow = document.createElement('tr');
                        newRow.innerHTML = '<td>' + cantidad + '</td>' +
                            '<td>' + nombreProducto + '</td>' +
                            '<td>' + costo.toFixed(2) + '</td>' +
                            '<td>' + total.toFixed(2) + '</td>';
                        document.getElementById('tabla_productos').appendChild(newRow);
                        calcularTotales();
                    } else {
                        console.log('Error: El costo no es un número válido.');
                    }
                },
                error: function() {
                    console.log('Error al obtener el costo del producto.');
                }
            });
        }

        function calcularTotales() {
            var subtotal = 0;
            var tableRows = document.querySelectorAll('#tabla_productos tbody tr');
            tableRows.forEach(function(row) {
                var totalCell = row.cells[3];
                subtotal += parseFloat(totalCell.textContent || totalCell.innerText);
            });
            document.getElementsByName('subtotal')[0].value = subtotal.toFixed(2);
            document.getElementsByName('impuesto')[0].value = (subtotal * 0.1).toFixed(2);
            document.getElementsByName('total')[0].value = (subtotal + (subtotal * 0.1)).toFixed(2);
        }
    </script>
    <?php require "../../include/footer.php"; ?>