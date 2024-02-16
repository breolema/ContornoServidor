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
    <title>Modificar Categorias</title>

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

        <h2>Dar de alta categoria</h2>
        <form action="upload.php" method="POST" enctype="multipart/form-data">
            <label for="foto">Selecciona una foto:</label>
            <input type="file" id="foto" name="foto"><br><br>
            <label for="nombreCat">Nombre de la categoria: </label>
            <input type="text" id="nombreCat" name="nombreCat" placeholder="Nombre" /><br><br>
            <label for="activo">Categoria activa: </label>
            <input type="checkbox" id="activo" name="activo" checked="checked"/><br><br>
        <input type="submit" value="Subir Foto">
    </form>
</body>

</html>