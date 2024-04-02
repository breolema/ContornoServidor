<?php
session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: inicioSesion.php");
    exit;
}

$conexion = mysqli_connect("localhost", "root", "", "supermercado");

if (isset($_SESSION["arrayCarrito"]) && !empty($_SESSION["arrayCarrito"])) {
    $arrayCarrito = $_SESSION["arrayCarrito"];
} else {
    header("Location: carrito.php");
    exit;
}

$stockSuficiente = true;
$productosActivos = true;

foreach ($arrayCarrito as $producto) {
    $codProducto = $producto['codprod'];
    $unidadesPedido = $producto['cantidad'];

    $verificarActivo = "SELECT CodEstado FROM productos WHERE CodProd = $codProducto";
    $resultadoVerificarActivo = $conexion->query($verificarActivo);
    if ($resultadoVerificarActivo->num_rows > 0) {
        $filaActivo = $resultadoVerificarActivo->fetch_assoc();
        $activo = $filaActivo['CodEstado'];
        if ($activo != 1) {
            $productosActivos = false;
            break;
        }
    }

    $comprobarStock = "SELECT stock FROM productos WHERE CodProd = $codProducto";
    $resultComprStock = $conexion->query($comprobarStock);
    if ($resultComprStock->num_rows > 0) {
        $filaStock = $resultComprStock->fetch_assoc();
        $stockDisponible = $filaStock['stock'];
        if ($stockDisponible < $unidadesPedido) {
            $stockSuficiente = false;
            break;
        }
    }
}

if (!$stockSuficiente || !$productosActivos) {
    $_SESSION['error_pedido'] = "Lo sentimos, no se puede procesar el pedido. Algunos productos no están disponibles o no tienen suficiente stock.";
    header("Location: carrito.php");
    exit;
}

$fecha = date('Y-m-d H:i:s');
$usuarioActual = $_SESSION["usuario"];
$sqlUserActual = "SELECT CodUsu FROM usuarios WHERE Nombre='$usuarioActual'";
$resultUserActual = $conexion->query($sqlUserActual);
$totalPrecio = 0;

foreach ($arrayCarrito as $producto) {
    $totalPrecio += $producto['precioFinal'];
}

if ($resultUserActual->num_rows > 0) {
    while ($fila = $resultUserActual->fetch_assoc()) {
        $codUserActual = $fila["CodUsu"];
    }
    $insertarPedido = "INSERT INTO pedidos (Fecha, CodUsuario, PrecioTotal, CodEstado) VALUES ('$fecha', $codUserActual, $totalPrecio, 1)";
    $resultInsert = $conexion->query($insertarPedido);
}


$codPedido = mysqli_insert_id($conexion);
foreach ($arrayCarrito as $producto) {
    $codProducto = $producto['codprod'];
    $unidades = $producto['cantidad'];
    $precio = $producto['precioFinal'];

    $insertarPedidosProducto = "INSERT INTO pedidosproductos (CodPed, CodProd, Unidades, Precio) VALUES ($codPedido, $codProducto, $unidades, $precio)";
    $resultInsertPedidosProducto = $conexion->query($insertarPedidosProducto);

    $actualizarStock = "UPDATE productos SET stock = stock - $unidades WHERE CodProd = $codProducto";
    $resultActualizarStock = $conexion->query($actualizarStock);

}

unset($_SESSION["arrayCarrito"]);

header("Location: enviarCorreo.php?codUsuario=$codUserActual&codPedido=$codPedido");
?>