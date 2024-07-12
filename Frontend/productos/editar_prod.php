<?php
require "../../include/header.php";
include '../../Backend/config/baseDeDatos.php';

$usuario = $_SESSION['usuario'];
if (!isset($usuario)) {
    header("location:../../index.php");
}

// Consulta de proveedores
$query = $conn->query("SELECT * FROM proveedores");
$query->execute();
$proveedores = $query->fetchAll(PDO::FETCH_OBJ);

// Consulta de categorías
$query2 = $conn->query("SELECT * FROM categorias");
$query2->execute();
$categorias = $query2->fetchAll(PDO::FETCH_OBJ);

$id_producto = $_GET['id'];
$query3 = $conn->prepare("SELECT productos.id_producto, productos.nombre_producto, productos.categoria, 
        productos.lote, productos.stock, productos.precio, productos.precio_compra,
        proveedores.id_proveedor, proveedores.nombre_prov, categorias.id_categoria, categorias.descripcion
        FROM productos 
        JOIN proveedores ON proveedores.id_proveedor = productos.id_proveedor 
        JOIN categorias ON categorias.id_categoria = productos.categoria 
        WHERE productos.id_producto = :id_producto");
$query3->bindParam(':id_producto', $id_producto, PDO::PARAM_INT);
$query3->execute();
$producto = $query3->fetch(PDO::FETCH_OBJ);
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
                    <h1 align="center">Editar Producto</h1>
                    <div class="row">
                        <div class="col-25">
                            <label for="fname">Nombre del Producto</label>
                        </div>
                        <div class="col-75">
                            <input type="text" id="fname" name="nombre_producto" required value='<?php echo $producto->nombre_producto; ?>'>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="categoria">Categoría</label>
                        </div>
                        <div class="col-75">
                            <select id="categoria" name="categoria" required>
                                <option value="">Seleccione una opción</option>
                                <?php
                                foreach ($categorias as $categoria) {
                                    $selected = ($categoria->id_categoria == $producto->categoria) ? 'selected' : '';
                                    echo "<option value='" . $categoria->id_categoria . "' $selected>" . $categoria->descripcion . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="lote">Lote</label>
                        </div>
                        <div class="col-75">
                            <input type="text" id="lote" name="lote" required value='<?php echo $producto->lote; ?>'>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="stock">Stock</label>
                        </div>
                        <div class="col-75">
                            <input type="number" id="stock" name="stock" required value='<?php echo $producto->stock; ?>'>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="precio">Precio de Venta</label>
                        </div>
                        <div class="col-75">
                            <input type="number" id="precio" name="precio" required value='<?php echo $producto->precio; ?>'>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="precio_compra">Precio de Compra</label>
                        </div>
                        <div class="col-75">
                            <input type="number" id="precio_compra" name="precio_compra" required value='<?php echo $producto->precio_compra; ?>'>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="proveedor">Proveedor</label>
                        </div>
                        <div class="col-75">
                            <select id="proveedor" name="id_proveedor" required>
                                <option value="">Seleccione una opción</option>
                                <?php
                                foreach ($proveedores as $prov) {
                                    $selected = ($prov->id_proveedor == $producto->id_proveedor) ? 'selected' : '';
                                    echo "<option value='" . $prov->id_proveedor . "' $selected>" . $prov->nombre_prov . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <input type="hidden" name="id_producto" value='<?php echo $producto->id_producto; ?>' readonly>
                        <input type="hidden" name="editar" value='si' readonly>
                        <input type="submit" value="Guardar" class="boton2">
                    </div>
                </form>
            </div>
        </div>
    </main>
</section>
<?php require "../../include/footer.php"; ?>
