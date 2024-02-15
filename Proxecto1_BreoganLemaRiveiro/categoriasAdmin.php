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
    <link rel="stylesheet" href="css/estilos_Categorias.css">

</head>

<body>
    <nav>
        <img src="imagenes/icono.png" alt="logo" />
        <a href="paginaGeneralAdmin.php">General</a>
        <a href="darAltaUsuarios.php">Alta usuarios</a>
        <a href="categoriasAdmin.php">Modificar categorias</a>
        <a href="productosAdmin.php">Modificar productos</a>
        <a href=""></a>
    </nav>

    <?php
            echo "<div class='categorias'>";
            $sql="SELECT codcat,nombre,rutaimagen FROM categorias WHERE Activa=TRUE";
            $result = $conexion->query($sql);
            if ($result->num_rows > 0) {
                while ($fila = $result -> fetch_assoc()) {
                    echo '<div class="categoria">';
                    echo '<img src="' . $fila["rutaimagen"] . '">';
                    echo '<h3 style="color:white;">' . $fila["nombre"] . '</h3>';
                    echo "<form action='modificarCategorias.php' method='POST'>";
                    echo '<input id="codcat" name="codcat" type="hidden" value="' . $fila["codcat"] . '" />';
                    echo '<br><input type="submit" value="Editar" class="editar">';
                    echo '</form>';
                    echo '</div>';
                }
                echo '</div>';
            }
        ?>
</body>

</html>