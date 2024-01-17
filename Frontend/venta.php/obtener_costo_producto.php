<?php
// obtener_costo_producto.php

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["productoId"])) {
   // Obtener el costo del producto desde la base de datos
   $mysqli = new mysqli("localhost", "root", "", "ferreteria");

   $productoId = $_GET["productoId"];
   $query = "SELECT costo FROM productos WHERE id_producto = ?";
   
   if ($stmt = $mysqli->prepare($query)) {
      $stmt->bind_param("i", $productoId);
      $stmt->execute();
      $stmt->bind_result($costo);

      if ($stmt->fetch()) {
         echo $costo;
      } else {
         echo "0"; // Valor predeterminado si no se encuentra el costo
      }

      $stmt->close();
   } else {
      echo "0"; // Valor predeterminado en caso de error en la preparación de la consulta
   }

   $mysqli->close();
} else {
   echo "0"; // Valor predeterminado en caso de solicitud incorrecta
}
?>
