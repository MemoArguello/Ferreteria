<?php
session_start();
include '../../Backend/config/baseDeDatos.php';

$usuario = $_SESSION['usuario'];
if (!isset($usuario)) {
    header("location:../../index.php");
}
$conexiondb = conectardb();
$query = "SELECT * FROM proveedores";
$resultado = mysqli_query($conexiondb, $query);


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
    <script>
            $(document).ready(function() {
                // Función para realizar la búsqueda de productos
                $("#producto").keyup(function() {
                    var query = $(this).val();

                    if (query != "") {
                        $.ajax({
                            url: "buscar_producto.php", // Ruta del archivo PHP para buscar productos
                            method: "POST",
                            data: {
                                query: query
                            },
                            success: function(data) {
                                if (data.trim() != "") {
                                    $("#selectProductos").html(data);
                                    $("#selectProductos").fadeIn();
                                } else {
                                    $("#selectProductos").fadeOut();
                                }
                            }
                        });
                    } else {
                        $("#selectProductos").fadeOut();
                    }
                });

                // Manejar la selección de un producto desde el select
                $("#selectProductos").change(function() {
                    var selectedProducto = $(this).val();
                    $("#producto").val(selectedProducto);
                    $("#selectProductos").fadeOut();
                });

                // Manejar clics fuera del select para ocultarlo
                $(document).on('click', function(e) {
                    if (!$(e.target).closest('.col-75').length) {
                        $("#selectProductos").fadeOut();
                    }
                });
            });
    </script>
    <style>
        /* Estilos para el select y sus opciones */
#selectProductos {
    width: 100%;
    padding: 10px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 5px;
    outline: none;
    cursor: pointer;
}

#selectProductos option {
    padding: 10px;
}

/* Estilos para el contenedor de la lista desplegable */
.col-75 {
    position: relative;
}

/* Estilos para el contenedor de opciones */
.select-options {
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    max-height: 150px;
    overflow-y: auto;
    background: #fff;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    display: none;
}

/* Estilos para cada opción de la lista desplegable */
.select-options option {
    padding: 10px;
    cursor: pointer;
    transition: background 0.3s;
}

.select-options option:hover {
    background: #f5f5f5;
}

/* Mostrar la lista desplegable cuando el campo de búsqueda tiene el foco */
#producto:focus + .select-options {
    display: block;
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
            <form action="../../Backend/venta/buscar.php" class="formRecepcion" method="POST">
                <h1 align="center">Realizar Venta</h1>
                <!-- Buscador de Productos -->
                <div class="row">
                    <div class="col-25">
                        <label for="producto">Nombre del Producto</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="lname" name="lote" placeholder="" required>
                    </div>
                </div>

                <!-- Buscador de Clientes -->
                <div class="row">
                    <div class="col-25">
                        <label for="cliente">Cliente</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="cliente" name="nombre_cliente" placeholder="Buscar Cliente" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-25">
                        <label for="lname">Cantidad</label>
                    </div>
                    <div class="col-75">
                        <input type="number" id="lname" name="lote" placeholder="" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="lname">Total a Pagar</label>
                    </div>
                    <div class="col-75">
                        <input type="number" id="lname" name="stock" placeholder="" required>
                    </div>
                </div>
                <br>
                <div class="row">
                    <input type="hidden" name="editar" id="" value='no' readonly>
                    <input type="submit" value="Guardar">
                </div>
            </form>
        </div>
    </section>
</body>

</html>