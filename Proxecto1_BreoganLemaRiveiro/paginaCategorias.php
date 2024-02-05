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
    <title>Categorias</title>
    <link rel="stylesheet" href="css/estilos_Categorias.css">
    <link rel="stylesheet" href="css/comunTodos.css">
</head>
    <body>
        <nav>
            <img src="imagenes/icono.png" alt="logo">
            <a href="inicio.php">Inicio</a>
            <a href="paginaCategorias.php">Categorias</a>
            <a href="">Ofertas</a>
            <a href="">Información</a>
        </nav>

<!--Enseñas as categorias activas-->
        <?php
            echo "<div class='categorias'>";
            $sql="SELECT codcat,nombre,rutaimagen FROM categorias WHERE Activa=TRUE";
            $contador=0;
            $result = $conexion->query($sql);
            if ($result->num_rows > 0) {
                while ($fila = $result -> fetch_assoc()) {
                    echo '<div class="categoria">';
                    echo '<img src="' . $fila["rutaimagen"] . '">';
                    echo '<a href="productos.php?codCat=' . $fila["codcat"] . '"><div class="nombre">' . $fila["nombre"] . '</div></a>';
                    echo '</div>';
                }
                echo '</div>';
            }
        ?>

    </body>
</html>