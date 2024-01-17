<?php
session_start();
include '../../Backend/config/baseDeDatos.php';

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
while ($usuario = mysqli_fetch_assoc($result)) {
    if ($usuario['id_cargo'] != 1) {
        header("location:../../index.php");
    }
}
$usuario = $_SESSION['usuario'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Venta</title>
    <link rel="stylesheet" href="../CSS/style.css">
    <link rel="stylesheet" href="../CSS/stiles.css">
    <link rel="stylesheet" href="../CSS/registrar.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


    <style>
        label {
            display: block;
            margin-bottom: 8px;
        }

        .boton {
            width: 15%;
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            float: right;
        }

        .boton:hover {
            background-color: #008604;
        }

        input {
            float: right;
            width: 30%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
        }

        select,
        textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid #ccc;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
        }



        @media screen and (max-width: 600px) {
            form {
                margin: 10px;
                padding: 10px;
            }

            input,
            select,
            textarea {
                margin-bottom: 8px;
            }

            table {
                margin-top: 10px;
            }
        }
    </style>
</head>

<body>
    <?php
    include($_SERVER['DOCUMENT_ROOT'] . '/Sistema_Ferreteria/Frontend/dashboard/inicio.php');
    ?>
    <section class="dashboard">
        <div class="top">
            <div class="topnav" id="myTopnav">
                <a href="./venta.php" <?php if (basename($_SERVER['PHP_SELF']) == 'venta.php') echo 'class="active"'; ?>>Venta</a>
                <a href="./registrar_productos.php" <?php if (basename($_SERVER['PHP_SELF']) == 'registrar_productos.php') echo 'class="active"'; ?>>Registros Venta</a>
            </div>
        </div>

        <div class="dash-content">
            <form action="procesar_factura.php" method="post" class="form_venta">
                <h1 align="center">Generar Factura</h1>
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
                            <!-- Obtener la lista de clientes desde la base de datos o algún otro origen -->
                            <?php
                            // Aquí deberías tener código para conectarte a la base de datos y obtener la lista de clientes
                            // Puedes usar mysqli o PDO para ello
                            // Ejemplo con mysqli:
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
                            <option value="Productos">Productos</option>
                            <option value="Servicios">Servicios</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <h3>Formulario de Productos:</h3>
                </div>

                <div class="row">
                    <div class="col-25">
                        <label for="categoria">Categoría:</label>
                    </div>
                    <div class="col-75">
                        <select name="categoria" id="categoria" onchange="cargarProductos(this.value)" required>
                            <!-- Obtener la lista de categorías desde la base de datos o algún otro origen -->
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
                    <input type="submit" value="Generar Factura">
                </div>
            </form>


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