<?php
     session_start();

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Páxina Principal</title>
    <style>

        body{
            margin: 0px;
            text-align: center;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            background-color: #fce4c6;
        }

        nav {
            background-color: #333;
            overflow: hidden;
        }
        

        nav a {
            float: left;
            display: block;
            color: white;
            text-align: center;
            padding: 25px 16px;
            text-decoration: none;
        }

        nav a:hover {
            background-color: #ddd;
            color: black;
        }

        nav img {
            float: left;
            padding: 10px;
            height: 50px;
        }
    </style>
</head>
    <body>
        <nav>
            <img src="imagenes/icono.png" alt="logo">
            <a href="">Inicio</a>
            <a href="">Categorias</a>
            <a href="">Ofertas</a>
            <a href="">Información</a>
        </nav>

    </body>
</html>