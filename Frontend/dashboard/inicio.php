<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Inicio</title>
	<link rel="stylesheet" href="../CSS/stiles.css">
	<script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
	<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
	<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
	<script>
		$(document).ready(function(){
			$(".hamburger").click(function(){
			  $(".wrapper").toggleClass("active")
			})
		});
	</script>
</head>
<body>

<div class="wrapper">

	<div class="top_navbar">
		<div class="logo">
			<a href="../inicio/inicio.php">FERRETERIA</a>
		</div>
	</div>

	<div class="main_body">
		
		<div class="sidebar_menu">
	        	<ul>
		          <li>
		            <a href="../inicio/inicio.php">
		              <span class="icon">
		              	<i class="uil uil-estate"></i></span>
		              <span class="list">Inicio</span>
		            </a>
		          </li>
		          <li>
		            <a href="#">
		              <span class="icon"><i class="lar la-money-bill-alt"></i></span>
		              <span class="list">Ventas</span>
		            </a>
		          </li>
				  <li>
		            <a href="../reportes/reporte_prod.php">
		              <span class="icon"><i class="las la-hammer"></i></span>
		              <span class="list">Productos</span>
		            </a>
		          </li>
		          <li>
		            <a href="../reportes/reporte_prov.php">
		              <span class="icon"><i class="las la-truck"></i></span>
		              <span class="list">Proveedores</span>
		            </a>
		          </li>
		          <li>
		            <a href="#">
		              <span class="icon"><i class="las la-chart-bar"></i></span>
		              <span class="list">Reportes</span>
		            </a>
		          </li>
		          <li>
		            <a href="#">
		              <span class="icon"><i class="las la-coins"></i></span>
		              <span class="list">Caja</span>
		            </a>
		          </li>
				  <li>
		            <a href="../reportes/reporte_cliente.php">
		              <span class="icon"><i class="las la-user"></i></span>
		              <span class="list">Clientes</span>
		            </a>
		          </li>
				  <li>
		            <a href="../reportes/reporte_cuenta.php">
		              <span class="icon"><i class="las la-cog"></i></span>
		              <span class="list">Configuracion</span>
		            </a>
		          </li>
				  <ul class="inner__sidebar_menu">
				  <li>
		            <a href="../../Backend/validacion/cerrar_sesion.php">
		              <span class="icon"><i class="las la-sign-out-alt"></i></span>
		              <span class="list">Cerrar Sesión</span>
		            </a>
		          </li>
				</ul>
		        </ul>
	        </div>
	</div>
</div>
</body>
</html>