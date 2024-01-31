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
    <title>Productos</title>
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

        .productos {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin-top: 20px;
        }

        .producto {
            width: calc(20% - 25px);
            margin: 0 15px 30px;
            text-align: center;
            border: 2px solid #333;
            border-radius: 10px;
            padding: 10px;
            background-color: #333;
            color: white;
        }
        
        .producto img {
            width: 50%;
            border-radius: 5px;
        }
        
        .comprar {
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

        .comprar:hover {
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
        <center>
        <?php
            $codcat=$_GET["codCat"];
            $sql_Categorias = "SELECT nombre FROM categorias WHERE codcat = $codcat && activa=TRUE";
            $result_Categorias = $conexion->query($sql_Categorias);

            if ($result_Categorias->num_rows == 0) {
                header("Location: paginaCategorias.php");
                exit;
            } else {
                while ($fila = $result_Categorias -> fetch_assoc()) {
                    echo "<h1>Usted se encuentra en la sección de ". $fila["nombre"] ."</h1>";
                }
            }

            $sql_Productos="SELECT codprod,nombre,descripcion,precio,stock,codcat,rutaimagen FROM productos WHERE codcat=$codcat && codestado=1";
            $result_Productos = $conexion->query($sql_Productos);
            
            echo "<div class='productos'>";
            if ($result_Productos->num_rows > 0) {
                while ($fila = $result_Productos -> fetch_assoc()) {
                    echo '<div class="producto">';
                    echo '<img src="' . $fila["rutaimagen"] . '">';
                    echo '<div><u>' . $fila["nombre"] . '</u></div>';
                    echo '<div>' . $fila["descripcion"] . '</div>';
                    echo '<div>' . $fila["precio"] . '€</div>';
                    echo '<div>' . $fila["stock"] . '</div>';
                    echo "<form action='carrito.php' method='POST'>";
                    echo '<input type="number" name="cantidad">';
                    echo '<input id="codprod" name="codprod" type="hidden" value="' . $fila["codprod"] . '" />';
                    echo '<br><input type="submit" value="Comprar" class="comprar">';
                    echo '</form>';
                    echo '</div>';
                }
                echo '</div>';
                }
        ?>
        </center>

    </body>
</html>
