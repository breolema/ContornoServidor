<?php
    session_start();

    if (!isset($_SESSION["usuario"])) {
        header("Location: inicioSesion.php");
        exit;
    }

    include_once("conexionbd.php");
    ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Productos</title>
    <link rel="stylesheet" href="css/estilos_Productos.css">
    <link rel="stylesheet" href="css/comunTodos.css">
    <link rel="icon" type="image/jpg" href="imagenes/icono.png"/>
    
</head>
    <body>
    <nav>
        <img src="imagenes/icono.png" alt="logo">
        <a href="inicio.php">Inicio</a>
        <a href="paginaCategorias.php">Categorias</a>
        <a href="misPedidos.php">Mis Pedidos</a>
        <a href="informacion.php">Información</a>
        <div  id="logout">
            <a href="logout.php"><img src="imagenes/logout.png"></a>
            <a href="carrito.php"><img src="imagenes/carrito.png"></a>
        </div>
    </nav>
        <center>
        <?php
            $codcat=$_GET["codCat"];

            //saca o nombre da categoria donde estamos
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

            //saca os productos cas suas imagenes
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
                    echo '<div>Stock: ' . $fila["stock"] . '</div>';
                    echo "<form action='añadirCarrito.php' method='POST'>";
                    echo '<input type="number" id="cantidad" name="cantidad" min="1" max="' . $fila["stock"] . '" required/>';
                    echo '<input id="codprod" name="codprod" type="hidden" value="' . $fila["codprod"] . '" />';
                    echo '<input id="codcat" name="codcat" type="hidden" value="' . $fila["codcat"] . '" />';
                    echo '<input id="precio" name="precio" type="hidden" value="' . $fila["precio"] . '" />';
                    echo '<br><input type="submit" value="Añadir al carro" class="comprar">';
                    echo '</form>';
                    echo '</div>';
                }
                echo '</div>';
                }
        ?>
        </center>

    </body>
</html>
