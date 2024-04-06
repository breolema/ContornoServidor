<?php
session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: inicioSesion.php");
    exit;
}

include_once("conexionbd.php");

if (isset($_SESSION["arrayCarrito"]) && !empty($_SESSION["arrayCarrito"])) {
    $arrayCarrito = $_SESSION["arrayCarrito"];
} else {
    header("Location: carrito.php");
    exit;
}

$stockSuficiente = true;
$productosActivos = true;

//facemos as seguintes comprobacions sobre cada un dos productos
foreach ($arrayCarrito as $producto) {
    $codProducto = $producto['codprod'];
    $unidadesPedido = $producto['cantidad'];
    //comprobamos si estan activos
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

    //comprobamos o stock de cada un dos productos
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

//si algun producto non ten stock ou non esta activo redirige a página do carro e enseña un mensaje de error
if (!$stockSuficiente || !$productosActivos) {
    $_SESSION['error_pedido'] = "Lo sentimos, no se puede procesar el pedido. Algunos productos no están disponibles o no tienen suficiente stock.";
    header("Location: carrito.php");
    exit;
}

//obtenemos fecha actual
$fecha = date('Y-m-d H:i:s');
//codigo usuario
$usuarioActual = $_SESSION["usuario"];
$sqlUserActual = "SELECT CodUsu FROM usuarios WHERE Nombre='$usuarioActual'";
$resultUserActual = $conexion->query($sqlUserActual);
$totalPrecio = 0;

foreach ($arrayCarrito as $producto) {
    $totalPrecio += $producto['precioFinal'];
}

//insertamos pedido
if ($resultUserActual->num_rows > 0) {
    while ($fila = $resultUserActual->fetch_assoc()) {
        $codUserActual = $fila["CodUsu"];
    }
    $insertarPedido = "INSERT INTO pedidos (Fecha, CodUsuario, PrecioTotal, CodEstado) VALUES ('$fecha', $codUserActual, $totalPrecio, 1)";
    $resultInsert = $conexion->query($insertarPedido);
}

//insertamos cada producto na tabla de pedidosproductos e actualizamos stock dos productos
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

//redirigimos a pagina de enviar o correo enviandolle por url os datos que queremos.
header("Location: enviarCorreo.php?codUsuario=$codUserActual&codPedido=$codPedido");
?>