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
    <link rel="icon" type="image/jpg" href="imagenes/icono.png"/>
  </head>
  <body>
  <nav>
      <img src="imagenes/icono.png" alt="logo" />
      <a href="paginaGeneralAdmin.php">General</a>
      <a href="darAltaUsuarios.php">Alta usuarios</a>
      <a href="categoriasAdmin.php">Modificar categorias</a>
      <a href="productosAdmin.php">Modificar productos</a>
      <div  id="logout">
            <a href="logout.php"><img src="imagenes/logout.png"></a>
      </div>
    </nav>

    </body>
</html>