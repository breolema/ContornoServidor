<?php
session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: inicioSesion.php");
    exit;
}

$conexion = mysqli_connect("localhost", "root", "", "supermercado");
error_reporting(E_ALL ^ E_WARNING);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Modificar Categorias</title>
    <link rel="stylesheet" href="css/comunTodos.css">
    <link rel="stylesheet" href="css/estilo_modificarCatProd.css">
</head>
<body>
<nav>
        <img src="imagenes/icono.png" alt="logo" />
        <a href="paginaGeneralAdmin.php">General</a>
        <a href="darAltaUsuarios.php">Alta usuarios</a>
        <a href="categoriasAdmin.php">Modificar categorias</a>
        <a href="productosAdmin.php">Modificar productos</a>
        <div  id="logout">
            <a href="logout.php"><img src="imagenes/logout.png"></a>
      </div>
    </nav>
<div class="container">
<?php
if(isset($_POST["codcat"])) {
    $codcat = $_POST["codcat"];
    $sql = "SELECT * FROM categorias WHERE CodCat = $codcat";
    $result = $conexion->query($sql);

    if ($result->num_rows > 0) {
         while ($row = $result->fetch_assoc()) {
            echo '<form method="POST" >';
            echo '<label id="codcat">Código de la categoría: ' . $row["CodCat"] . '</label>';
            echo '<label for="nombreCat">Nombre de la categoría:</label>';
            echo '<input type="text" id="nombreCat" name="nombreCat" value="' . $row["Nombre"] . '"><br><br>';
            echo '<label for="foto">Selecciona una foto:</label>';
            echo '<input type="file" id="foto" name="foto"><br><br>';
            echo '<label for="activo">Categoría activa:</label>';
            echo '<input type="checkbox" id="activo" name="activo" ' . ($row["Activa"] == 1 ? 'checked' : '') . '><br><br>';
            echo '<input type="hidden" name="codcat" value="' . $row["CodCat"] . '">';
            echo '<input type="submit" value="Guardar cambios">';
            echo '</form>';
        }
    } else {
        echo "No se encontró la categoría seleccionada.";
    }
} else {
    echo "No se envió el código de la categoría.";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST["codcat"])) {
        $codcat = $_POST["codcat"];
        $nombreCat = $_POST["nombreCat"];
        $activo = isset($_POST["activo"]) ? 1 : 0;
        //imagen

        $updateCategoria = "UPDATE categorias SET Nombre = '$nombreCat',  Activa = $activo, RutaImagen='imagenes/categorias/$rutaImagen' WHERE CodCat = $codcat";
        if($conexion->query($updateCategoria)) {
            echo "Los datos se han actualizado correctamente.";
        } else {
            echo "Error al actualizar los datos. Por favor, inténtelo de nuevo.";
        }

    }
}
?>
</div>
<script>
    alert("<?php echo $mensaje; ?>");
</script>

</body>
</html>