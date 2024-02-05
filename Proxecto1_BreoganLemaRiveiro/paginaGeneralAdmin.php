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
    <link rel="stylesheet" href="css/comunTodos.css">
  </head>
  <body>
  <nav>
      <img src="imagenes/icono.png" alt="logo" />
      <a href="paginaGeneralAdmin.php">General</a>
      <a href="darAltaUsuarios.php">Alta usuarios</a>
      <a href="categoriasAdmin.php">Modificar categorias</a>
      <a href="productosAdmin.php">Mdificar productos</a>
      <a href=""></a>
    </nav>

    </body>
</html>