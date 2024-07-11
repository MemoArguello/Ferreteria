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
    padding: 8px 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin-top: 10px;
    cursor: pointer;
    border-radius: 5px;
}


#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #04AA6D;
  color: white;
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
                    <div class="left">
                        <h1>Generar Factura</h1>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="cliente">Ingrese Cedula del Cliente:</label>
                        </div>
                        <div class="col-75">
                            <input type="text" id="ciCliente" name="cedula" placeholder="Cedula" required>
                            <button class="boton" onclick="consultarCliente();">Buscar</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="tipo">Cliente:</label>
                        </div>
                        <div class="col-75">
                            <input type="text" id="nombreCliente" readonly placeholder="Nombre del Cliente">
                            <button class="boton" onclick="insertarFactura();">Iniciar Factura</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="tipo">Factura N°:</label>
                        </div>
                        <div class="col-75">
                            <input type="text" id="numeroFactura" readonly>
                        </div>
                    </div>
                    <div class="left">
                        <h2>Agrega un Productos:</h2>
                    </div>
                    <br>
                    <br>
                    <div class="row">
                        <div class="col-25">
                            <label for="categoria">Producto:</label>
                        </div>
                        <div class="col-75">
                            <input type="text" id="idProducto" name="producto" placeholder="Ingrese Nombre">
                            <button class="boton" onclick="consultarCliente();">Agregar</button>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-25">
                            <label for="producto">Cantidad:</label>
                        </div>
                        <div class="col-75">
                            <input type="text" id="txtCantidad" name="cantidad" placeholder="Cantidad">
                        </div>
                    </div>

                    <div class="left">
                        <h3>Productos Seleccionados</h3>
                    </div>
                    <table id="customers">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Precio</th>
                                <th scope="col">Cantidad</th>
                                <th scope="col">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody id="resultadoProducto">

                        </tbody>
                    </table>
                    <h4 id="subtotal">Sub Total:</h4>
                    <h4 id="iva">IVA %:</h4>
                    <h4 id="total">Total Factura:</h4>
                    <div class="row">
                        <input type="hidden" name="id_usuario" value='<?= $resultado['id_usuario'] ?>' readonly>
                        <br>
                        <input type="submit" class="boton2" value="Vender">
                    </div>
            </div>
        </div>
    </main>
</section>

<script>
    var id=0;
    var idFactura=0;
    var Total=0;

    function consultarCliente(){
        var ciCliente =document.getElementById("ciCliente").value;
        $.ajax({
            url:'consultar_cliente.php',
            method: 'POST',
            data: {
                ciCliente : ciCliente
            },
            dataType: 'json',
            success:function(data){
                if(data.error){
                    alert(data.error)
                }else{
                    document.getElementById("nombreCliente").value = data.nombre_cliente;
                    id = data.id_cliente;
                }
            }
        })
    }

    function insertarFactura(){
        $.ajax({
            url:'procesar_factura.php',
            method: 'POST',
            data: {
                id_cliente : id
            },
            dataType: 'json',
            success:function(data){
                if(data.success){
                    var id_factura = data.id_factura
                    document.getElementById("numeroFactura").value = data.id_factura;
                    idFactura = id_factura;
                }else{
                    alert("Error al insertar la factura"+data.error)
                }
            }
        })
    }
</script>

<?php require "../../include/footer.php"; ?>