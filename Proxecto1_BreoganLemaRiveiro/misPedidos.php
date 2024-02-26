<?php
     session_start();

     if (!isset($_SESSION["usuario"])) {
        header("Location: inicioSesion.php");
        exit;
    }

    $conexion = mysqli_connect("localhost", "root", "", "supermercado");

    $usuarioActual = $_SESSION["usuario"];
    $sqlUserActual = "SELECT CodUsu FROM usuarios WHERE Nombre='$usuarioActual'";
    $resultUserActual = $conexion->query($sqlUserActual); 

   
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis pedidos</title>
    <link rel="stylesheet" href="css/comunTodos.css">
    <link rel="icon" type="image/jpg" href="imagenes/icono.png"/>
    <style>
       table {
            width: 80%; 
            margin: 0 auto; 
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        img {
            max-width: 100px;
            max-height: 100px;
        }
    </style>
</head>
<body>
<nav>
        <img src="imagenes/icono.png" alt="logo">
        <a href="inicio.php">Inicio</a>
        <a href="paginaCategorias.php">Categorias</a>
        <a href="misPedidos.php">Mis Pedidos</a>
        <a href="">Información</a>
        <div  id="logout">
            <a href="logout.php"><img src="imagenes/logout.png"></a>
            <a href="carrito.php"><img src="imagenes/carrito.png"></a>
        </div>
    </nav>

    <?php
        $codUserActual=0;
        if ($resultUserActual->num_rows > 0) {
            while ($fila = $resultUserActual -> fetch_assoc()) {
                $codUserActual= $fila["CodUsu"];
            }
        }

        $sqlPedidos= "SELECT pedidos.CodPed AS CodigoPedido, pedidos.Fecha, estadoPedido.Descripcion AS EstadoPedido, pedidos.PrecioTotal
                                FROM pedidos
                                INNER JOIN estadoPedido ON pedidos.CodEstado = estadoPedido.CodEstadoPedido
                                WHERE pedidos.CodUsuario = '$codUserActual'
                                ORDER BY Fecha DESC";
         $resultPedidos = $conexion->query($sqlPedidos); 

         if ($resultPedidos->num_rows > 0) {
            while ($fila = $resultPedidos->fetch_assoc()) {
                echo "<h2>Pedido nº" . $fila['CodigoPedido'] . "</h2>";
                echo "<p>Fecha: " . $fila['Fecha'] . "</p>";
                echo "<p>Estado: " . $fila['EstadoPedido'] . "</p>";
                echo "<p>Precio Total: $" . $fila['PrecioTotal'] . "</p>";

                $codigoPedido = $fila['CodigoPedido'];

                $sqlProductosPedido = "SELECT productos.Nombre AS NombreProducto, productos.Descripcion AS DescripcionProducto, pedidosproductos.Unidades AS Unidades, productos.Precio AS PrecioProducto, productos.RutaImagen AS FotoProducto
                                    FROM pedidosproductos
                                    INNER JOIN productos ON pedidosproductos.CodProd = productos.CodProd
                                    WHERE pedidosproductos.CodPed = '$codigoPedido'";
                $resultProductosPedido = $conexion->query($sqlProductosPedido);

                if ($resultProductosPedido->num_rows > 0) {
                    echo "<table>";
                    echo "<tr><th>Producto</th><th>Descripción</th><th>Unidades</th><th>Precio Producto</th><th>Foto</th></tr>";
                    while ($filaProducto = $resultProductosPedido->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $filaProducto['NombreProducto'] . "</td>";
                        echo "<td>" . $filaProducto['DescripcionProducto'] . "</td>";
                        echo "<td>" . $filaProducto['Unidades'] . "</td>";
                        echo "<td>$" . $filaProducto['PrecioProducto'] . "</td>";
                        echo "<td><img src='" . $filaProducto['FotoProducto'] . "' alt='Foto del Producto'></td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                } else {
                    echo "<p>No se encontraron productos para este pedido.</p>";
                }
            }
        } else {
            echo "<p>No se encontraron pedidos.</p>";
        }

    ?>
</body>
</html>