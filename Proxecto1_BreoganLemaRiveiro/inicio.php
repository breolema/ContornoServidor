<?php
     session_start();

     if (!isset($_SESSION["usuario"])) {
        header("Location: inicioSesion.php");
        exit;
    }
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inicio</title>
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
        .tarjeta-registro {
        background-color: #333;
        padding: 20px;
        text-align: center;
        margin-top: 20px;
    }

    .tarjeta-registro h2 {
        font-size: 26px;
        margin-bottom: 10px;
        color: #4CAF50;
    }

    .tarjeta-registro ul {
        list-style: none;
        padding: 0;
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        margin-bottom: 20px;
    }

    .tarjeta-registro li {
        font-size: 17px;
        margin: 0 10px 10px 0;
        padding: 5px;
        border-radius: 5px;
        background-color: #4CAF50;
    }
</style>

<body>
    
<nav>
            <img src="imagenes/icono.png" alt="logo">
            <a href="inicio.php">Inicio</a>
            <a href="paginaCategorias.php">Categorias</a>
            <a href="">Ofertas</a>
            <a href="">Información</a>
        </nav>
    <section class="tarjeta-registro">
        <h2>¡Consigue tu tarjeta y tendrás más ventajas!</h2>
        <ul>
            <li>Promociones exclusivas</li>
            <li>Vales ahorro personalizados</li>
            <li>La app con todas las ventajas en tu bolsillo</li>
            <li>Te escuchamos: Tu opinión cuenta</li>
            <li>Y además, viajes y regalos ...</li>
        </ul>
    </section>
</body>

</html>