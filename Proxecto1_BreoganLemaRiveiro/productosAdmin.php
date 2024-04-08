<?php
session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: inicioSesion.php");
    exit;
}

require_once("conexionbd.php");
error_reporting(E_ALL ^ E_WARNING);

$usuarioActual = $_SESSION["usuario"];
$sqlUserActual = "SELECT CodUsu FROM usuarios WHERE Nombre='$usuarioActual'";
$resultUserActual = $conexion->query($sqlUserActual);
if ($resultUserActual->num_rows > 0) {
    while ($fila = $resultUserActual->fetch_assoc()) {
        $codUserActual = $fila["CodUsu"];
    }
}

//update do producto
if (isset($_POST["CodProd"])) {
    $codprod = $_POST["CodProd"];
    $nombreProd = $_POST["nombreProd"];
    $descripcion = $_POST["descripcProd"];
    $precioProd = $_POST["precioProd"];
    $stock = $_POST["stock"];
    $categoria = $_POST["categoria"];
    $estado = isset($_POST["estado"]) ? 1 : 0;

    if ($stock > 0) {
        $updateProducto = "UPDATE productos SET Nombre = '$nombreProd', 
                    Descripcion = '$descripcion',
                    Precio = $precioProd, 
                    Stock = $stock, 
                    CodCat = $categoria, 
                    CodEstado = $estado 
                    WHERE CodProd = $codprod";

        $resultUpdate = $conexion->query($updateProducto);
        $rexistroUpdate="INSERT INTO historialmodificaciones (CodUsuario,Descripcion) VALUES ('$codUserActual','O usuario $codUserActual modificou o producto $nombreProd')";
        $resultRexistroUpdate = $conexion->query($rexistroUpdate);
    }
    header("Location: productosAdmin.php");
    exit;
}



//insert do novo producto
if (isset($_GET["insertar"])) {
    //comprobamos que se añaden todos os campos
    if (isset($_GET["nombreProd"], $_GET["descripProd"], $_GET["precioProd"], $_GET["stock"], $_GET["categoria"], $_GET["rutaImagen"])) {
        $nombreProd = $_GET["nombreProd"];
        $descripProd = $_GET["descripProd"];
        $precioProd = $_GET["precioProd"];
        $stock = $_GET["stock"];
        $categoria = $_GET["categoria"];
        $estado = isset($_GET["estado"]) ? 1 : 0;
        $rutaImagen = $_GET["rutaImagen"];

        //inserccion na bd
        if($nombreProd!="" || $precioProd!="" ||$stock!="" ||$categoria!="" ){
        $insert = "INSERT INTO productos (Nombre, Descripcion, Precio, Stock, CodCat, CodEstado, RutaImagen)
                   VALUES ('$nombreProd', '$descripProd', $precioProd, $stock, $categoria, $estado, 'imagenes/productos/$rutaImagen')";
        $resultInsert = $conexion->query($insert);
        $rexistroInsert = "INSERT INTO historialmodificaciones (CodUsuario, Descripcion) VALUES ('$codUserActual','O usuario $codUserActual insertou o producto $nombreProd')";
        $resultRexistroUpdate = $conexion->query($rexistroInsert);
        header("Location: productosAdmin.php");
        exit;
        } else {
            $_SESSION["mensaje"]="Error: Falta uno o más campos requeridos.";
            header("Location: productosAdmin.php");
            exit;
        }
    } else {
        //non se proporcionan todos os campos
        echo "Error: Falta uno o más campos requeridos.";
    }
}


if (isset($_SESSION["mensaje"])) {
    echo "<script>alert('" . $_SESSION["mensaje"] . "');</script>";
    unset($_SESSION["mensaje"]);
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Modificar Productos</title>
    <link rel="stylesheet" href="css/estilos_Productos.css">
    <link rel="stylesheet" href="css/comunTodos.css">
    <link rel="stylesheet" href="css/estilo_AltaCategoriasProd.css">
    <link rel="icon" type="image/jpg" href="imagenes/icono.png" />

</head>

<body>
    <nav>
        <img src="imagenes/icono.png" alt="logo" />
        <a href="todosPedidos.php">Pedidos</a>
        <a href="darAltaUsuarios.php">Alta usuarios</a>
        <a href="categoriasAdmin.php">Modificar categorias</a>
        <a href="productosAdmin.php">Modificar productos</a>
        <div id="logout">
            <a href="logout.php"><img src="imagenes/logout.png"></a>
        </div>
    </nav>
    <center>
        <?php
        $sql_Categorias = "SELECT codcat, nombre FROM categorias";
        $result_Categorias = $conexion->query($sql_Categorias);

        $categorias = array();

        if ($result_Categorias->num_rows > 0) {
            while ($filaCategoria = $result_Categorias->fetch_assoc()) {
                $categorias[$filaCategoria['codcat']] = $filaCategoria['nombre'];
            }
        }

        //lista de productos por categoría
        foreach ($categorias as $codcat => $nombre_categoria) {
            echo "<h2>$nombre_categoria</h2>";

            $sql_Productos = "SELECT codprod, nombre, descripcion, precio, stock, codestado, rutaimagen FROM productos WHERE codcat = $codcat";
            $result_Productos = $conexion->query($sql_Productos);

            echo "<div class='productos'>";
            if ($result_Productos->num_rows > 0) {
                while ($fila = $result_Productos->fetch_assoc()) {
                    //imprimir detalles do producto
                    echo '<div class="producto">';
                    echo '<img src="' . $fila["rutaimagen"] . '">';
                    echo '<div><u>' . $fila["nombre"] . '</u></div>';
                    echo '<div>' . $fila["descripcion"] . '</div>';
                    echo '<div>Precio: ' . $fila["precio"] . '€</div>';
                    echo '<div>Stock: ' . $fila["stock"] . '</div>';
                    if ($fila["codestado"] == 1) {
                        echo '<div>Activo</div>';
                    } else {
                        echo '<div>Desactivo</div>';
                    }

                    echo "<form method='GET'>";
                    echo '<input id="codProd" name="codProd" type="hidden" value="' . $fila["codprod"] . '" />';
                    echo '<br><input type="submit" value="Editar" class="editar">';
                    echo '</form>';
                    echo "<form action='borrarCatProd.php' method='POST'>";
                    echo '<input id="codprod" name="codprod" type="hidden" value="' . $fila["codprod"] . '" />';
                    echo '<br><input type="submit" value="Borrar Producto" class="borrar">';
                    echo '</form>';
                    echo '</div>';
                }
            } else {
                echo "<p>No hay productos en esta categoría.</p>";
            }
            echo "</div>";
        }

        //si recibimos por get o codigo do producto pintamos a tabla de update
        if (isset($_GET["codProd"])) {
            $codprod = $_GET["codProd"];
            $sql = "SELECT * FROM productos WHERE CodProd = '$codprod'";
            $result = $conexion->query($sql);

            if ($result->num_rows > 0) {
                echo '<div class="container">';
                echo '<form method="POST" >';
                while ($fila = $result->fetch_assoc()) {
                    echo '<label id="CodProd" name="CodProd">Código de producto:' . $fila["CodProd"] . '</label>';
                    echo '<input type="hidden" name="CodProd" value="' . $fila["CodProd"] . '">';
                    echo '<label for="nombreProd">Nombre del producto:</label>';
                    echo '<input type="text" id="nombreProd" name="nombreProd" value="' . $fila["Nombre"] . '">';
                    echo '<label for="descripcProd">Descripcion del producto:</label>';
                    echo '<input type="text" id="descripcProd" name="descripcProd" value="' . $fila["Descripcion"] . '">';
                    echo '<label for="precioProd">Precio del producto (en €):</label>';
                    echo '<input type="number" id="precioProd" name="precioProd" step="0.01" value="' . $fila["Precio"] . '">';
                    echo '<label for="stock">Stock del producto:</label>';
                    echo '<input type="number" id="stock" name="stock" min="1" value="' . $fila["Stock"] . '">';
                    echo '<label for="categoria">Categoría del producto:</label>';
                    echo ' <select id="categoria" name="categoria">';

                    $sqlCat = "SELECT categorias.CodCat, categorias.Nombre FROM categorias
                                        INNER JOIN productos ON categorias.CodCat=productos.CodCat
                                        WHERE productos.CodProd=" . $fila['CodProd'] . "";
                    $resultCat = $conexion->query($sqlCat);

                    if ($resultCat->num_rows > 0) {
                        while ($filaCat = $resultCat->fetch_assoc()) {
                            echo "<option value='" . $filaCat['CodCat'] . "'>" . $filaCat['Nombre'] . "</option>";
                        }
                    }
                    echo ' </select>';
                    echo '<label for="estado">Producto activo:</label>';
                    echo '<input type="checkbox" id="estado" name="estado" ' . ($fila["CodEstado"] == 1 ? 'checked' : '') . '>';
                    echo '<input type="submit" value="Guardar cambios" class="editar">';
                    echo '</form>';
                }
                echo '</div>';
            }


        } else {
            ?>

            <h2>Dar de alta producto</h2>
            <div class="container">
                <form method="GET">
                    <input type="hidden" value="true" name="insertar">
                    <label for="rutaImagen">Selecciona una foto:</label>
                    <input type="file" id="rutaImagen" name="rutaImagen"><br>
                    <label for="nombreProd">Nombre del producto: </label>
                    <input type="text" id="nombreProd" name="nombreProd" placeholder="Nombre" /><br>
                    <label for="descripProd">Descripcion del producto: </label>
                    <input type="text" id="descripProd" name="descripProd" placeholder="Descripcion" /><br>
                    <label for="precioProd">Precio del producto: </label>
                    <input type="number" id="precioProd" name="precioProd" step="0.01" /><br>
                    <label for="stock">Stock del producto: </label>
                    <input type="number" id="stock" name="stock" min="1" /><br>
                    <label for="categoria">Selecciona la categoría:</label>
                    <select id="categoria" name="categoria">
                        <option value="">-Seleccione una opción-</option>
                        <?php
                        $sqlCat = "SELECT CodCat, Nombre FROM categorias";
                        $resultCat = $conexion->query($sqlCat);

                        if ($resultCat->num_rows > 0) {
                            while ($fila = $resultCat->fetch_assoc()) {
                                echo "<option value='" . $fila['CodCat'] . "'>" . $fila['Nombre'] . "</option>";
                            }
                        } else {
                            echo "<option value=''>No hay categorías disponibles</option>";
                        }

                        ?>
                    </select><br>
                    <label for="estado">Producto activo: </label>
                    <input type="checkbox" id="estado" name="estado" checked="checked" /><br>
                    <input type="submit" value="Añadir producto" class="editar">
                </form>
            </div>

            <?php

        }

        ?>
    </center>

</body>

</html>