<?php
    session_start();

    if (!isset($_SESSION["usuario"])) {
        header("Location: inicioSesion.php");
        exit;
    }

    $conexion = mysqli_connect("localhost", "root", "", "supermercado");
    
    ?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <title>Alta clientes</title>
    
    <link rel="stylesheet" href="css/estilos_AltaUsers.css">
    <link rel="stylesheet" href="css/comunTodos.css">

  </head>
  <body>
    <nav>
      <img src="imagenes/icono.png" alt="logo" />
      <a href="">General</a>
      <a href="darAltaUsuarios.php">Alta usuarios</a>
      <a href="">Modificar categorias</a>
      <a href="">Mdificar productos</a>
      <a href=""></a>
    </nav>

    </body>
</html>