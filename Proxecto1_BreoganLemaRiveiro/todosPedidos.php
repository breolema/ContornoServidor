<?php
session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: inicioSesion.php");
    exit;
}

$conexion = mysqli_connect("localhost", "root", "", "supermercado");

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todos los pedidos</title>
    <link rel="stylesheet" href="css/comunTodos.css">
    <link rel="stylesheet" href="css/estilos_MisPedidos.css">
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

    <h1>Pagina de Pedidos</h1>

    <?php

$sqlPedidos = "SELECT pedidos.CodUsuario, usuarios.Nombre AS NombreUsuario, pedidos.CodPed AS CodigoPedido, pedidos.Fecha, pedidos.PrecioTotal
                FROM pedidos
                INNER JOIN usuarios ON pedidos.CodUsuario = usuarios.CodUsu
                ORDER BY Fecha DESC";
    $resultPedidos = $conexion->query($sqlPedidos);

    if ($resultPedidos->num_rows > 0) {
        while ($fila = $resultPedidos->fetch_assoc()) {
            echo "<h2>Pedido nº" . $fila['CodigoPedido'] . "</h2>";
            echo "<p>Fecha: " . $fila['Fecha'] . "</p>";
            echo "<p>Estado: ";
            echo "<form action='actualizarEstadoPedido.php' method='POST'>";
            echo "<input type='hidden' name='codigoPedido' value='" . $fila['CodigoPedido'] . "'>";

            $estadoActualPedido="SELECT estadopedido.CodEstadoPedido, estadopedido.Descripcion, pedidos.CodEstado FROM estadopedido
			                    INNER JOIN pedidos ON estadopedido.CodEstadoPedido=pedidos.CodEstado
			                    WHERE pedidos.CodPed=" . $fila['CodigoPedido'] . "";
            $resultEstadoActual = $conexion->query($estadoActualPedido);
            while ($filaEstadoActual = $resultEstadoActual->fetch_assoc()) {
                echo "<p>Estado actual del pedido: " . $filaEstadoActual['Descripcion']. "</p>";
            }

            echo "<select name='nuevoEstado'>";

            $sqlEstadosPedido = "SELECT * FROM estadoPedido";
            $resultEstadosPedido = $conexion->query($sqlEstadosPedido);
            if ($resultEstadosPedido->num_rows > 0) {
                while ($filaEstado = $resultEstadosPedido->fetch_assoc()) {
                echo "<option value='" . $filaEstado['CodEstadoPedido'] . "'>" . $filaEstado['Descripcion'] . "</option>";
                }
            }
        echo "</select>";
        echo "<button type='submit' class='botoncito'>Actualizar Estado</button>";
        echo "</form>";
        echo "</p>";

            echo "<p>Precio Total: " . $fila['PrecioTotal'] . "€</p>";
            
            echo "<p>Pedido hecho por el usuario: " . $fila['NombreUsuario'] . "</p>";

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
                echo "<form action='descargarPedido.php' method='post'>";
                echo "<input type='hidden' name='codigoPedido' value='" . $codigoPedido . "'>";
                echo "<button type='submit' class='boton'>Descargar PDF</button>";
                echo "</form>";
                echo "<form action='borrarPedido.php' method='post'>";
                echo "<input type='hidden' name='codigoPedido' value='" . $codigoPedido . "'>";
                echo "<button type='submit' class='boton'>Borrar Pedido</button>";
                echo "</form>";

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