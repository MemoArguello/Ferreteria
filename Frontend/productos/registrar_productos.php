<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/style.css">
    <link rel="stylesheet" href="../CSS/stiles.css">
    <link rel="stylesheet" href="../CSS/registrar.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <title>Productos</title>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
</head>
<body>
    <?php 
        include($_SERVER['DOCUMENT_ROOT'] . '/Sistema_Ferreteria/Frontend/dashboard/inicio.php');
    ?>
        <section class="dashboard">
        <div class="top">
            <div class="topnav" id="myTopnav">
                <a href="../reportes/reporte_cliente.php" <?php if (basename($_SERVER['PHP_SELF']) == '../reportes/reporte_cliente.php') echo 'class="active"'; ?>>Clientes</a>
                <a href="./registrar_productos.php" <?php if (basename($_SERVER['PHP_SELF']) == 'registrar_productos.php') echo 'class="active"'; ?>>Registrar</a>
            </div>
        </div>

        <div class="dash-content">
            <form action="../../Backend/cliente/guardar_cliente.php" class="formRecepcion" method="POST">
                <h1 align="center">Registrar Producto</h1>
                <div class="row">
                    <div class="col-25">
                        <label for="fname">Nombre del Producto</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="fname" name="nombre_producto" placeholder="" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="lname">Categoria</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="lname" name="categoria" placeholder="" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="lname">Stock</label>
                    </div>
                    <div class="col-75">
                        <input type="number" id="lname" name="apellido" placeholder="" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="lname">Precio</label>
                    </div>      
                    <div class="col-75">
                        <input type="text" id="lname" name="ruc" placeholder="" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="country">Proveedor</label>
                    </div>
                    <div class="col-75">
                        <select id="ciudad" name="id_ciudad" required>
                            <option value="">Seleccione una opción</option> <!-- Opción en blanco -->
                            <?php
                            while ($proveedor = mysqli_fetch_assoc($resultado2)) {
                                echo "<option value='" . $ciudad['id_proveedor'] . "'>" . $ciudad['nombre_prov'] . "</option>";
                            }
                            ?>
                        </select>
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