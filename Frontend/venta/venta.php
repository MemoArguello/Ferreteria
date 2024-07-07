<?php require "../../include/header.php" ?>
<?php require "../../backend/config/baseDeDatos.php"?>
<?php


$usuario = $_SESSION['usuario'];
if (!isset($usuario)) {
    header("location:../../index.php");
}
$conexiondb = conectardb();
$query = "SELECT * FROM categorias ORDER BY id_categoria";
$resultado = mysqli_query($conexiondb, $query);

$query2 = "SELECT * FROM productos WHERE categoria = 'id_categoria'";
$resultado2 = mysqli_query($conexiondb, $query2);

$sql = "SELECT id_cargo FROM `usuarios` WHERE usuario = '$usuario';";
$result = mysqli_query($conexiondb, $sql);

$usuario = $_SESSION['usuario'];

// Consulta para obtener el ID del usuario a partir del nombre de usuario
$queryUsuario = "SELECT id_usuario FROM usuarios WHERE usuario = '$usuario'";
$resultadoUsuario = mysqli_query($conexiondb, $queryUsuario);

// Verificar si se obtuvo el resultado
if ($resultadoUsuario) {
    // Obtener el ID del usuario
    $usuarioInfo = mysqli_fetch_assoc($resultadoUsuario);
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
                                    $mysqli = new mysqli("localhost", "root", "", "ferreteria");
                                    $result = $mysqli->query("SELECT id_cliente, nombre FROM cliente");

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
                                    // Aquí deberías tener código similar para obtener la lista de categorías
                                    $resultCategorias = $mysqli->query("SELECT id_categoria, descripcion FROM categorias");

                                    while ($rowCategoria = $resultCategorias->fetch_assoc()) {
                                        echo "<option value='{$rowCategoria['id_categoria']}'>{$rowCategoria['descripcion']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <!-- Dentro de la sección del formulario -->
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

                        <!-- Tabla para mostrar los productos seleccionados -->
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
                            <input type="hidden" name="id_usuario" id="" value='<?php echo $idUsuario[0]; ?>' readonly>
                            <br>
                            <input type="submit" class="boton2" value="Vender">
                        </div>
                    </form>
                </div>
            </div>
        </main>

        <script>
            function cargarProductos(idCategoria) {
                // Aquí puedes realizar una solicitud AJAX para cargar los productos de la categoría seleccionada
                // Puedes utilizar JavaScript puro o alguna biblioteca como jQuery
                // ...

                // Ejemplo con jQuery:
                $.ajax({
                    url: 'cargar_productos.php',
                    method: 'GET',
                    data: {
                        id_categoria: idCategoria
                    },
                    success: function(data) {
                        // Actualizar el contenido del select de productos
                        $('#producto').html(data);
                    }
                });
            }

            // Puedes agregar más funciones JavaScript según sea necesario para manejar la lógica del formulario
        </script>
</body>
<script src="../dashboard/script.js"></script>

<script>
    function agregarProducto() {
        var productoSelect = document.getElementsByName('producto[]')[0];
        var cantidadInput = document.getElementsByName('cantidad[]')[0];

        var productoId = productoSelect.value;
        var productoNombre = productoSelect.options[productoSelect.selectedIndex].text; // Obtén el nombre del producto
        var cantidad = cantidadInput.value;

        // Llamar a la función para cargar el costo del producto
        cargarCostoProducto(productoId, cantidad, productoNombre);
    }


    function cargarCostoProducto(idProducto, cantidad, nombreProducto) {
        // Realizar una solicitud AJAX para obtener el costo del producto
        $.ajax({
            url: 'obtener_costo_producto.php',
            method: 'GET',
            data: {
                productoId: idProducto // Corregir el nombre del parámetro
            },
            success: function(data) {
                // Obtener el costo real del producto
                var costo = parseFloat(data);

                // Verificar si el costo es un número válido
                if (!isNaN(costo)) {
                    // Calcular el total con el costo real del producto
                    var total = cantidad * costo;

                    // Crear una nueva fila para la tabla con los detalles del producto
                    var newRow = document.createElement('tr');
                    newRow.innerHTML = '<td>' + cantidad + '</td>' +
                        '<td>' + nombreProducto + '</td>' +
                        '<td>' + costo.toFixed(2) + '</td>' + // Asegurar dos decimales en el costo
                        '<td>' + total.toFixed(2) + '</td>'; // Asegurar dos decimales en el total

                    // Agregar la fila a la tabla
                    document.getElementById('tabla_productos').appendChild(newRow);

                    // Calcular y actualizar totales
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
        // Lógica para calcular y actualizar los totales
        var subtotal = 0;

        // Iterar sobre las filas de la tabla
        var tableRows = document.querySelectorAll('#tabla_productos tbody tr');
        tableRows.forEach(function(row) {
            var totalCell = row.cells[3];
            subtotal += parseFloat(totalCell.textContent || totalCell.innerText);
        });

        // Actualizar los campos de totales en el formulario
        document.getElementsByName('subtotal')[0].value = subtotal.toFixed(2);
        document.getElementsByName('impuesto')[0].value = (subtotal * 0.1).toFixed(2);
        document.getElementsByName('total')[0].value = (subtotal + (subtotal * 0.1)).toFixed(2);
    }
</script>

</html>