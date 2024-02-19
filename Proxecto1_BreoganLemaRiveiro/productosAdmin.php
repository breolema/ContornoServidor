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
    <title>Modificar Productos</title>
    <link rel="stylesheet" href="css/estilos_Productos.css">
    <link rel="stylesheet" href="css/comunTodos.css">
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
                    echo '<br><input type="submit" value="Editar" class="editar">';
                    echo '</form>';
                    echo '</div>';
                }
                echo '</div>';
                }
        ?>

<h2>Dar de alta producto</h2>
<div class="container">
<form method="POST">
    <label for="foto">Selecciona una foto:</label>
    <input type="file" id="foto" name="foto"><br>
    <label for="nombreProd">Nombre del producto: </label>
    <input type="text" id="nombreProd" name="nombreProd" placeholder="Nombre" /><br>
    <label for="descripProd">Descripcion del producto: </label>
    <input type="text" id="descripProd" name="descripProd" placeholder="Descripcion" /><br>
    <label for="precioProd">Precio del producto: </label>
    <input type="number" id="precioProd" name="precioProd"  step="0.01"/><br>
    <label for="stock">Stock del producto: </label>
    <input type="number" id="stock" name="stock" /><br>
    <label for="categoria">Selecciona la categoría:</label>
    <select id="categoria" name="categoria">
    <option value="">-Seleccione una opción-</option>
        <?php
            $sqlCat = "SELECT CodCat, Nombre FROM categorias WHERE Activa = 1";
            $resultCat = $conexion->query($sqlCat);

            if ($resultCat->num_rows > 0) {
                while ($fila = $resultCat -> fetch_assoc()) {
                    echo "<option value='" . $fila['CodCat'] . "'>" . $fila['Nombre'] . "</option>";
                }
            } else {
                echo "<option value=''>No hay categorías disponibles</option>";
            }

        ?>
    </select><br>
    <label for="estado">Producto activo: </label>
    <input type="checkbox" id="estado" name="estado" checked="checked"/><br>
    <input type="submit" value="Añadir producto" class="editar">
</form>
</div>

<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nombreProd = $_POST["nombreProd"];
        $descripProd = $_POST["descripProd"];
        $precioProd = $_POST["precioProd"];
        $stock = $_POST["stock"];
        $categoria = $_POST["categoria"];
        $estado = isset($_POST["estado"]) ? 1 : 0;
    
        //imagen aqui 
    
        $insert = "INSERT INTO productos (Nombre, Descripcion, Precio, Stock, CodCat, CodEstado, RutaImagen)
                        VALUES ('$nombreProd', '$descripProd', $precioProd, $stock, $categoria, $estado, '$rutaImagen')";
        $resultInsert = $conexion->query($insert);
    
        if ($resultInsert) {
            $mensaje = "Producto añadido correctamente.";
        } else {
            $mensaje = "Error al añadir el producto. Por favor, inténtelo de nuevo.";
        }
    }
?>
<script>
    alert("<?php echo $mensaje; ?>");
</script>
</center>

    </body>
</html>
