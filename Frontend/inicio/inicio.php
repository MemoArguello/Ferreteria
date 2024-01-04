<?php
session_start();
include '../../Backend/config/baseDeDatos.php';

$usuario = $_SESSION['usuario'];
if (!isset($usuario)) {
    header("location:../../index.php");
}
$conexiondb = conectardb();
$sql = "SELECT id_cargo FROM `usuarios` WHERE usuario = '$usuario';";
$result = mysqli_query($conexiondb, $sql);
while ($usuario = mysqli_fetch_assoc($result)) {
    if ($usuario['id_cargo'] != 1) {
        header("location:../../index.php");
    }
}
$usuario = $_SESSION['usuario'];

$conexiondb = conectardb();
$query1 = "SELECT COUNT(*) total1 FROM cargo";
$query2 = "SELECT COUNT(*) total2 FROM usuarios";
$query3 = "SELECT COUNT(*) total3 FROM usuarios";
$query4 = "SELECT COUNT(*) total4 FROM usuarios";
$query5 = "SELECT sum(id_usuario) total5 FROM usuarios";
$query6 = "SELECT SUM(id_usuario) total6 FROM usuarios";


$resultado1 = mysqli_query($conexiondb, $query1);
$resultado2 = mysqli_query($conexiondb, $query2);
$resultado3 = mysqli_query($conexiondb, $query3);
$resultado4 = mysqli_query($conexiondb, $query4);
$resultado5 = mysqli_query($conexiondb, $query5);
$resultado6 = mysqli_query($conexiondb, $query6);



?>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@600&family=Quicksand&family=Roboto+Condensed:wght@300&display=swap');

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "lato", sans-serif;
    }

    .card-head span {
        font-size: 5.2rem;
        color: #2e323a;
    }

    .card img {
        height: 120px;
        width: 150px;
    }

    .card {
        box-shadow: 0px 10px 10px -5px rgb(0 0 0 / 10%);
        background: #DDD;
        padding: 40px;
        height: 200px;
        width: 340px;
    }

    .card-head {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .analytics {
        font-family: 'Poppins', sans-serif;
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        grid-gap: 2rem;
        margin-top: 0.5rem;
        margin-bottom: 2rem;
    }

    .page-content {
        padding: 1.3rem 1rem;
        background: #f1f4f9;
    }
</style>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" href="../CSS/style.css">
    <link rel="stylesheet" href="../CSS/stiles.css">
    <link rel="stylesheet" href="../CSS/registrar.css">
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
                <a href="#" <?php if (basename($_SERVER['PHP_SELF']) == './inicio.php') echo 'class="active"'; ?>>Inicio</a>
                <a href="#" <?php if (basename($_SERVER['PHP_SELF']) == 'formulario_cliente.php') echo 'class="active"'; ?>>Auditoria</a>
            </div>
        </div>
        <br>
        <div class="dash-content">
            <div class="analytics">
                <div class="card">
                    <div class="card-head">
                        <?php
                        while ($reserva = mysqli_fetch_assoc($resultado1)) {
                            if ($reserva['total1'] == '1') {
                                echo "<td align= 'center'>" . $reserva['total1'] . ' Cliente Registrado' . "</td>";
                            } else {
                                echo "<td align= 'center'>" . $reserva['total1'] . ' Clientes Registrados' . "</td>";
                            }
                        }
                        ?>
                        <img src="../IMG/client.png" class="" alt="...">
                    </div>
                </div>
                <div class="card">
                    <div class="card-head">
                        <?php
                        while ($reserva = mysqli_fetch_assoc($resultado2)) {
                            if ($reserva['total2'] == 1) {
                                echo "<td align= 'center'>" . $reserva['total2'] . ' Producto Registrado' . "</td>";
                            } else {
                                echo "<td align= 'center'>" . $reserva['total2'] . ' Productos Registrados' . "</td>";
                            }
                        }
                        ?>
                        <img src="../IMG/producto.png" class="" alt="...">
                    </div>
                </div>
                <div class="card">
                    <div class="card-head">
                        <?php
                        while ($reserva = mysqli_fetch_assoc($resultado3)) {
                            echo "<td align= 'center'>" . $reserva['total3'] . ' Proveedores Registrados' . "</td>";
                        }
                        ?>
                        <img src="../IMG/img1.png" class="" alt="...">
                    </div>
                </div>
                <div class="card">
                    <div class="card-head">
                        <?php
                        while ($reserva = mysqli_fetch_assoc($resultado4)) {
                            if ($reserva['total4'] == 1) {
                                echo "<td align= 'center'>" . $reserva['total4'] . ' Producto Registrado' . "</td>";
                            } else {
                                echo "<td align= 'center'>" . $reserva['total4'] . ' Productos Registrados' . "</td>";
                            }
                        }
                        ?>
                        <img src="../IMG/img4.png" class="" alt="...">
                    </div>
                </div>
                <div class="card">
                    <div class="card-head">
                        <?php
                        while ($reserva = mysqli_fetch_assoc($resultado5)) {
                            echo "<td align= 'center'>" . $reserva['total5'] . ' Gs en Ventas Realizadas' . "</td>";
                        }
                        ?>
                        <img src="../IMG/img3.png" class="" alt="...">
                    </div>
                </div>
                <div class="card">
                    <div class="card-head">
                        <?php
                        while ($reserva = mysqli_fetch_assoc($resultado6)) {
                            echo "<td align= 'center'>" . $reserva['total6'] . ' Gs en Compras Realizadas' . "</td>";
                        }
                        ?>
                        <img src="../IMG/img2.png" class="" alt="...">
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>