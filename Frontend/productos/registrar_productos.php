<?php require "../../include/header.php" ?>
<?php require "../../backend/config/baseDeDatos.php"?>
<?php

$usuario = $_SESSION['usuario'];
if (!isset($usuario)) {
    header("location:../../index.php");
}
try {
    // Consulta a proveedores
    $query = $conn->query("SELECT * FROM proveedores");
    $query->execute();
    $resultado1 = $query->fetchAll(PDO::FETCH_ASSOC);

    // Consulta a categorías
    $query2 = $conn->query("SELECT * FROM categorias");
    $query2->execute();
    $resultado2 = $query2->fetchAll(PDO::FETCH_ASSOC);

    //obtener usuario para auditoria
    $consulta= $conn->query("SELECT id_usuario FROM usuarios where usuario ='$usuario'");
    $consulta->execute();
    
    $resultado3 =$consulta->fetch(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit();
}

?>
    <section id="content">
        <main>
                <div class="left">
                    <nav class="nav">
                        <ul class="breadcrumb">
                            <li>
                                <a class="active" href="../reportes/reporte_prod.php">Productos</a>
                            </li>
                        </ul>
                        <ul class="breadcrumb">
                            <li>
                                <a class="active" href="./registrar_productos.php">Registrar</a>
                            </li>
                        </ul>
                    </nav>
                </div>

            <div class="table-data">
                <div class="container">

                    <form action="../../Backend/producto/guardar_product.php" class="form_vent" method="POST">
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
                                <label for="country">Categoria</label>
                            </div>
                            <div class="col-75">
                                <select id="proveedor" name="categoria" required>
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
                                <label for="lname">Lote</label>
                            </div>
                            <div class="col-75">
                                <input type="text" id="lname" name="lote" placeholder="" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-25">
                                <label for="lname">Stock</label>
                            </div>
                            <div class="col-75">
                                <input type="number" id="lname" name="stock" placeholder="" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-25">
                                <label for="lname">Precio de Venta</label>
                            </div>
                            <div class="col-75">
                                <input type="number" id="lname" name="precio" placeholder="" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-25">
                                <label for="lname">Precio de compra</label>
                            </div>
                            <div class="col-75">
                                <input type="number" id="lname" name="precio_compra" placeholder="" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-25">
                                <label for="country">Proveedor</label>
                            </div>
                            <div class="col-75">
                                <select id="proveedor" name="id_proveedor" onchange="getCiudades(this.value)" required>
                                    <option value="">Seleccione una opción</option>
                                    <?php
                                    foreach ($resultado1 as $proveedor) {
                                        echo "<option value='" . $proveedor['id_proveedor'] . "'>" . $proveedor['nombre_prov'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <input type="hidden" name="id_usuario" id="" value='<?= $resultado3['id_usuario'] ?>' readonly>
                            <input type="hidden" name="editar" id="" value='no' readonly>
                            <input type="submit" value="Guardar" class="boton2">
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </section>
    <script src="../dashboard/script.js"></script>

</body>

</html>