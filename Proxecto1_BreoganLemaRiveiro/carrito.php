<?php
     session_start();

     if (!isset($_SESSION["usuario"])) {
        header("Location: inicioSesion.php");
        exit;
    }

    if(isset($_SESSION["arrayCarrito"])){
        $arrayCarrito = $_SESSION["arrayCarrito"];
    } else {
        $arrayCarrito = [];
    }
    

    $conexion = mysqli_connect("localhost", "root", "", "supermercado");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito Compra</title>
    <link rel="stylesheet" href="css/comunTodos.css">
</head>
<body>

    <nav>
       <a href="inicio.php"><img src="imagenes/icono.png" alt="logo"></a>
    </nav>
    <?php
        echo "<h2>Carrito de compras</h2>";
        if (!empty($arrayCarrito)) {
            echo "<table border='1'>";
            echo "<tr><th>Código de Producto</th><th>Cantidad</th><th>Precio Unitario</th><th>Precio Total</th></tr>";
            foreach ($arrayCarrito as $producto) {
                echo "<tr>";
                $sqlImagen = "SELECT RutaImagen FROM productos WHERE CodProd=" . $producto['codprod'] . "";
                $resultImagen = $conexion->query($sqlImagen);
                while ($fila = $resultImagen -> fetch_assoc()) {
                    echo "<td><img src=" . $fila['RutaImagen'] . "></td>";
                }
                echo "<td>" . $producto['cantidad'] . "</td>";
                echo "<td>" . $producto['precio'] . "</td>";
                echo "<td>" . $producto['precioFinal'] . "</td>";
                echo "<td>Borrar</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No hay productos en el carrito.</p>";
        }

    ?>
</body>
</html>