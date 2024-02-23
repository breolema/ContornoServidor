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

    if (isset($_SESSION['error_pedido'])) {
        $mensajeError = $_SESSION['error_pedido'];
        unset($_SESSION['error_pedido']);
    } else {
        $mensajeError = "";
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
    <link rel="stylesheet" href="css/estilo_Carrito.css">
    <link rel="icon" type="image/jpg" href="imagenes/icono.png"/>

    <?php if (!empty($mensajeError)) { ?>
        <script>
            window.onload = function() {
                alert("<?php echo $mensajeError; ?>");
            };
        </script>
    <?php } ?>
    
</head>
<body>

<nav>
        <img src="imagenes/icono.png" alt="logo">
        <a href="paginaCategorias.php">Seguir Comprando</a>
    </nav>
    <?php
        $totalPrecio=0;

        echo "<h2>Carrito de compras</h2>";
        if (!empty($arrayCarrito)) {
            echo "<table>";
            foreach ($arrayCarrito as $producto) {
                echo "<tr>";
                $sqlImagen = "SELECT RutaImagen FROM productos WHERE CodProd=" . $producto['codprod'] . "";
                $resultImagen = $conexion->query($sqlImagen);
                while ($fila = $resultImagen -> fetch_assoc()) {
                    echo "<td><img class='imgPedido' src=" . $fila['RutaImagen'] . "></td>";
                }
                echo "<td>Cantidad: " . $producto['cantidad'] . "</td>";
                echo "<td>Precio unidad: " . $producto['precio'] . "€</td>";
                echo "<td>Precio producto: " . $producto['precioFinal'] . "€</td>";
                echo "<td>";
                echo "<form action='borrarProdCarrito.php' method='POST'>";
                echo "<input type='hidden' id ='codprod' name='codprod' value='" . $producto['codprod'] . "'>";
                echo "<button type='submit' class='botonBorrar'>Borrar</button>";
                echo "</td>";
                echo "</form>";
                echo "</tr>";

                $totalPrecio += $producto['precioFinal'];
            }
            echo "</table>";
            echo "<form action='crearPedido.php' method='POST'>";
            echo "<p class='total'>Total del pedido: " . $totalPrecio . "€</p>";
            echo "<button class='realizarPedido'>Realizar Pedido</button>";
            echo "</form>";
        } else {
            echo "<p class='carroVacio'>No hay productos en el carrito.</p>";
        }

       
    ?>
</body>
</html>