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
    <link rel="stylesheet" href="css/estilos_Productos.css">
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
        <center>
        <?php
            $sql_Productos="SELECT codprod,nombre,descripcion,precio,stock,rutaimagen FROM productos";
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
                    echo "<form action='modificarProductos.php' method='POST'>";
                    echo '<input id="codprod" name="codprod" type="hidden" value="' . $fila["codprod"] . '" />';
                    echo '<br><input type="submit" value="Editar" class="comprar">';
                    echo '</form>';
                    echo '</div>';
                }
                echo '</div>';
                }
        ?>
        </center>

    </body>
</html>
