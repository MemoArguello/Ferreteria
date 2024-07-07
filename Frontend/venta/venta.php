<?php require "../../include/header.php" ?>
<?php require "../../backend/config/baseDeDatos.php"?>
<?php


$usuario = $_SESSION['usuario'];
if (!isset($usuario)) {
    header("location:../../index.php");
    exit();
}

$query = $conn->query("SELECT * FROM categorias ORDER BY id_categoria");

$query2 = $conn->query("SELECT * FROM productos WHERE categoria = 'id_categoria'");

$usuario = $_SESSION['usuario'];

// Consulta para obtener el ID del usuario a partir del nombre de usuario
$queryUsuario = $conn->query("SELECT id_usuario FROM usuarios WHERE usuario = '$usuario'");

// Verificar si se obtuvo el resultado
if ($queryUsuario && $queryUsuario->rowCount() > 0) {
    // Obtener el ID del usuario
    $usuarioInfo = $queryUsuario->fetch(PDO::FETCH_ASSOC);
    $idUsuario = $usuarioInfo['id_usuario'];
} else {
    // Manejar el error si la consulta no fue exitosa
    echo "Error al obtener el ID del usuario.";
    exit();
}
?>

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
                                $result = $conn->query("SELECT id_cliente, nombre FROM cliente");
                                while ($row = $result->fetch_assoc()) {
                                    echo "<option value='{$row['id_cliente']}'>{$row['nombre']}</option>";
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
                    <div class="row">
                        <div class="col-25">
                            <label for="categoria">Categoría:</label>
                        </div>
                        <div class="col-75">
                            <select name="categoria" id="categoria" onchange="cargarProductos(this.value)" required>
                                <option value="">Seleccione una opción</option>
                                <?php
                                $resultCategorias = $conn->query("SELECT id_categoria, descripcion FROM categorias");
                                while ($rowCategoria = $resultCategorias->fetch_assoc()) {
                                    echo "<option value='{$rowCategoria['id_categoria']}'>{$rowCategoria['descripcion']}</option>";
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
                        <input type="button" class="boton" value="Agregar" onclick="agregarProducto()">
                    </div>
                    <table border="1">
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
