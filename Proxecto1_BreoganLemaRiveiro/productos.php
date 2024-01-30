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

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        table {
            border-collapse: collapse;
            width: auto;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
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
            $result = $conexion->query($sql_Categorias);

            if ($result->num_rows == 0) {
                header("Location: paginaCategorias.php");
                exit;
            } else {
                while ($fila = $result -> fetch_assoc()) {
                    echo "<h1>Usted se encuentra en la seccion de ". $fila["nombre"] ."</h1>";
                }
            }

            $sql_Productos="SELECT codprod,nombre,descripcion,precio,stock,codcat FROM productos WHERE codcat=$codcat && codestado=1";
            $result = $conexion->query($sql_Productos);

            if ($result->num_rows > 0) {
                echo "<table border=1 class='container'>";
                echo "<tr><th>Producto</th><th>Descripción</th><th>Precio</th><th>Stock</th><th>Comprar</th></tr>";
                while ($fila = $result -> fetch_assoc()) {
                    echo "<tr>";
                        echo "<td>". $fila["nombre"] ."</td>";
                        echo "<td>". $fila["descripcion"] ."</td>";
                        echo "<td>". $fila["precio"] ."</td>";
                        echo "<td>". $fila["stock"] ."</td>";
                        echo "<td></td>";
                    echo "</tr>";
                }
                echo "</table>";
            }
        ?>
        </center>

    </body>
</html>
