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
    <title>Modificar Productos</title>
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

    <?php
        if (isset($_POST["codprod"])) {
            $codprod = $_POST["codprod"];
            $sql = "SELECT * FROM productos WHERE codprod = '$codprod'";
            $result = $conexion->query($sql);

            if ($result->num_rows > 0) {
                while ($fila = $result->fetch_assoc()) {
                    echo '<form method="POST" >';
                    echo '<label id="codprod">Código de producto:'. $row["CodProd"] . '</label>';
                    echo '<label for="nombreProd">Nombre del producto:</label>';
                    echo '<input type="text" id="nombreProd" name="nombreProd" value="' . $row["Nombre"] . '"><br><br>';
                    echo '<label for="precioProd">Precio del producto:</label>';
                    echo '<input type="number" id="precioProd" name="precioProd" step="0.01" value="'. $row["Precio"] .'"><br><br>';
                    echo '<label for="stock">Stock del producto:</label>';
                    echo '<input type="number" id="stock" name="stock" value="' . $row["Stock"] . '"><br><br>';
                    echo '<label for="categoria">Categoría del producto:</label>';
                    echo ' <select id="categoria" name="categoria">';

                    $sqlCategorias = "SELECT CodCat, Nombre FROM categorias WHERE Activa = 1";
                    $resultCategorias = $conexion->query($sqlCategorias);
                    if ($resultCategorias->num_rows > 0) {
                        
                    }
                }
            }
        }
    ?>
</body>
</html>