<?php require "../../include/header.php" ?>
<?php require "../../backend/config/baseDeDatos.php"?>
<?php

$usuario = $_SESSION['usuario'];
if (empty($usuario)) {
    header("location:../../index.php");
}
$sql = $conn->query("SELECT productos.id_producto, productos.nombre_producto, productos.categoria, productos.lote, productos.stock, productos.precio, productos.precio_compra, categorias.descripcion AS categoria, proveedores.nombre_prov AS proveedor FROM productos JOIN categorias ON categorias.id_categoria = productos.categoria
                    JOIN proveedores ON proveedores.id_proveedor = productos.id_proveedor WHERE productos.estado = 1");
$sql->execute();

$productoTotal = $sql->fetchAll(PDO::FETCH_OBJ);
?>
    <section id="content">
    <main>
                <div class="left">
                    <nav class="nav">
                        <ul class="breadcrumb">
                            <li>
                                <a class="active" href="./reporte_prod.php">Productos</a>
                            </li>
                        </ul>
                        <ul class="breadcrumb">
                            <li>
                                <a class="active" href="../productos/registrar_productos.php">Registrar</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            <div class="table-data">
            <div class="container">
                <div class="titulo" align="center" >
                    <h2>Listado de Productos</h2>
                </div>
                <ul class="pdf">
                        <li>
                            <a class="active" href="PDF/pdf_prod.php" target="_blank">Reporte PDF</a>
                        </li>
                </ul>
                <div class"row">
                    <div class="col-lg-12">
                        <table id="listado" class="table-striped table-bordered" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Nombre</th>
                                    <th>Categoria</th>
                                    <th>Lote</th>
                                    <th>Stock</th>
                                    <th>Precio Venta</th>
                                    <th>Precio Compra</th>
                                    <th>Proveedor</th>
                                    <th>Editar</th>
                                    <th>Eliminar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1; foreach($productoTotal as $producto):?>
                                    <tr>
                                        <td><?=$i++?></td>
                                        <td><?=$producto->nombre_producto?></td>
                                        <td><?=$producto->categoria?></td>
                                        <td><?=$producto->lote?></td>
                                        <td><?=$producto->stock?></td>
                                        <td><?=$producto->precio?></td>
                                        <td><?=$producto->precio_compra?></td>
                                        <td><?=$producto->proveedor?></td>
                                        <td>
                                            <a class="submitBotonEditar" href="../productos/editar_prod.php?id=<?=$producto->id_producto?>">
                                                <i class='bx bx-edit'></i>
                                            </a>
                                        </td>
                                        <td>
                                            <form id="formEliminarProd<?=$producto->id_producto?>" action="../../Backend/producto/eliminar_prod.php" method="POST">
                                                <input type="hidden" name="id" value="<?=$producto->id_producto?>">
                                                <button type="button" class="submitBotonEliminar" onclick="confirmarEliminarProd(<?=$producto->id_producto?>)">
                                                    <i class='bx bx-trash' ></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </main>
    </section>
<?php require "../../include/footer.php"; ?>