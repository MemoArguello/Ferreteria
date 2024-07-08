<?php 
  session_start(); // Asegúrate de que la sesión está iniciada

  if(isset($_SESSION['usuario'])){
    header("location: ".APPURL."");
    exit;
  }

  if(isset($_POST['submit'])){
    if(empty($_POST['email']) OR empty($_POST['codigo'])){
      echo "<script>alert('Rellene todos los campos, Por favor')</script>";
    } else {
      $email = $_POST['email'];
      $codigo = $_POST['codigo'];

      // Preparar la consulta con PDO
      $login = $conn->prepare("SELECT * FROM usuarios WHERE email = :email");
      $login->execute([':email' => $email]);

      // Obtener el resultado
      $fetch = $login->fetch(PDO::FETCH_ASSOC);

      // Verificar si se encontró el usuario y si la contraseña es correcta
      if($login->rowCount() > 0){
          if(password_verify($codigo, $fetch['codigo'])){
            // Almacenar los datos del usuario en la sesión
            $_SESSION['usuario'] = $fetch['nombreUsuario'];
            $_SESSION['email'] = $fetch['email'];
            $_SESSION['id_user'] = $fetch['id_usuario'];

            // Redirigir al usuario
            header("location: ".APPURL."");
            exit;
          } else {
            echo "<script>alert('Email o Contraseña Incorrecta')</script>";
          }        
      } else {
        echo "<script>alert('Email o Contraseña Incorrecta')</script>";
      }
    }
  }
?>
