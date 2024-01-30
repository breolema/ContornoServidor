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

        .categorias {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin-top: 20px;
        }
        
        .categoria {
            width: calc(25% - 30px);
            margin: 0 15px 30px;
            text-align: center;
            border: 2px solid #333;
            border-radius: 10px;
            padding: 10px;
            background-color: #333;
        }
        
        .categoria img {
            width: 50%;
            border-radius: 5px;
        }
        
        .nombre {
            margin-top: 10px;
            font-size: 17px;
            background-color: #4CAF50;
            color: white; 
            padding: 10px 20px; 
            border: none;
            border-radius: 5px; 
            cursor: pointer;
            text-decoration: none;
        }

        a{
            text-decoration: none;
        }

        .nombre:hover {
            background-color: #45a049;
        }
        
    </style>
</head>
    <body>
        <nav>
            <img src="imagenes/icono.png" alt="logo">
            <a href="inicio.php">Inicio</a>
            <a href="paginaCategorias.php">Categorias</a>
            <a href="">Ofertas</a>
            <a href="">Información</a>
        </nav>

        <?php
            echo "<div class='categorias'>";
            $sql="SELECT nombre,rutaimagen FROM categorias WHERE Activa=TRUE";
            $contador=0;
            $result = $conexion->query($sql);
            if ($result->num_rows > 0) {
                while ($fila = $result -> fetch_assoc()) {
                    echo '<div class="categoria">';
                    echo '<img src="' . $fila["rutaimagen"] . '">';
                    echo '<a href="subcategorias.php"><div class="nombre">' . $fila["nombre"] . '</div></a>';
                    echo '</div>';
                }
            
                echo '</div>';
            }
        ?>

    </body>
</html>