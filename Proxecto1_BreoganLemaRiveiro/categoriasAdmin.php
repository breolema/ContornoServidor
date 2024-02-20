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
    <link rel="stylesheet" href="css/estilo_AltaCategoriasProd.css">

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

    <?php
    echo "<div class='categorias'>";
    $sql="SELECT codcat,nombre,rutaimagen FROM categorias";
    $result = $conexion->query($sql);
    if ($result->num_rows > 0) {
        while ($fila = $result -> fetch_assoc()) {
            echo '<div class="categoria">';
            echo '<img src="' . $fila["rutaimagen"] . '">';
            echo '<h3 style="color:white;">' . $fila["nombre"] . '</h3>';
            echo "<form method='GET'>";
            echo '<input id="codcat" name="codcat" type="hidden" value="' . $fila["codcat"] . '" />';
            echo '<br><input type="submit" value="Editar" class="editar">';
            echo '</form>';
            echo '</div>';
        }
        echo '</div>';
    }


        //si lle damos a modificar algunha das categorias envia por get os datos
            if(isset($_GET["codcat"])){
                
            if(isset($_GET["codcat"])) {
                $codcat = $_GET["codcat"];
                $sql = "SELECT * FROM categorias WHERE CodCat = $codcat";
                $result = $conexion->query($sql);
                
                echo '<div class="container">';
                if ($result->num_rows > 0) {
                     while ($row = $result->fetch_assoc()) {
                        echo '<h2>Modificar categoria ' . $row["Nombre"] . '</h2>';
                        echo '<form method="POST" >';
                        echo '<label id="codcat">Código de la categoría: ' . $row["CodCat"] . '</label>';
                        echo '<label for="nombreCat">Nombre de la categoría:</label>';
                        echo '<input type="text" id="nombreCat" name="nombreCat" value="' . $row["Nombre"] . '">';
                        echo '<label for="activo">Categoría activa:</label>';
                        echo '<input type="checkbox" id="activo" name="activo" ' . ($row["Activa"] == 1 ? 'checked' : '') . '>';
                        echo '<input type="hidden" name="codcat" value="' . $row["CodCat"] . '">';
                        echo '<input type="submit" value="Actualizar" class="editar">';
                        echo '</form>';
                    }
                }
                echo '</div>';
                }

            if(isset($_POST["codcat"])) {
                $codcat = $_POST["codcat"];
                $nombreCat = $_POST["nombreCat"];
                $activo = isset($_POST["activo"]) ? 1 : 0;

                $updateCategoria = "UPDATE categorias SET Nombre = '$nombreCat',  Activa = $activo WHERE CodCat = $codcat";
                $resultUpdate = $conexion->query($updateCategoria);
                header("Location: categoriasAdmin.php");
            }


            //si non lle mandamos por get esta pinta o de dar alta categorias
            } else {
        ?>
        <h2>Dar de alta categoria</h2>
        <div class="container">
        <form method="POST">
            <label for="foto">Selecciona una foto:</label>
            <input type="file" id="foto" name="foto">
            <label for="nombreCat">Nombre de la categoria: </label>
            <input type="text" id="nombreCat" name="nombreCat" placeholder="Nombre" />
            <label for="activo">Categoria activa: </label>
            <input type="checkbox" id="activo" name="activo" checked="checked"/>
            <input type="submit" value="Añadir categoria" class="editar">
        </form>
        </div>

        <?php
              if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $nombreCat = $_POST["nombreCat"];
                $activo = isset($_POST["activo"]) ? 1 : 0;
                $rutaImagen=$_POST["foto"];
            
                $insert = "INSERT INTO categorias (Nombre, Activa, RutaImagen) 
                                VALUES ('$nombreCat', $activo, 'imagenes/categorias/$rutaImagen')";
                $resultInsert = $conexion->query($insert);
            
                if ($resultInsert) {
                    $mensaje = "Categoría añadida correctamente.";
                } else {
                    $mensaje = "Error al añadir la categoría. Por favor, inténtelo de nuevo.";
                }
            }
            
        }
        ?>
        <script>
            alert("<?php echo $mensaje; ?>");
        </script>
</body>

</html>