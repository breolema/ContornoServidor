<?php
     session_start();

     if (!isset($_SESSION["usuario"])) {
        header("Location: inicioSesion.php");
        exit;
    }

    $conexion = mysqli_connect("localhost", "root", "", "supermercado");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis pedidos</title>
    <link rel="stylesheet" href="css/comunTodos.css">
    <link rel="icon" type="image/jpg" href="imagenes/icono.png"/>
</head>
<body>
<nav>
        <img src="imagenes/icono.png" alt="logo">
        <a href="inicio.php">Inicio</a>
        <a href="paginaCategorias.php">Categorias</a>
        <a href="misPedidos.php">Mis Pedidos</a>
        <a href="">Información</a>
        <div  id="logout">
            <a href="logout.php"><img src="imagenes/logout.png"></a>
            <a href="carrito.php"><img src="imagenes/carrito.png"></a>
        </div>
    </nav>

    <?php

    ?>
</body>
</html>