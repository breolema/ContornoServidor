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

foreach ($arrayCarrito as $producto) {
    $codProducto = $producto['codprod'];
    $unidadesPedido = $producto['cantidad'];

    $comprobarStock = "SELECT stock FROM productos WHERE CodProd = $codProducto";
    $resultComprStock = $conexion->query($comprobarStock);

    if($resultComprStock->num_rows > 0) {
        $filaStock = $resultComprStock -> fetch_assoc();
        $stockDisponible = $filaStock['stock'];
        if ($stockDisponible < $unidadesPedido) {
            //mensaxe
            exit;
        }
    } else {
        //mensaxe si non se pode acceder o stock
        exit;
    }
}

$fecha = date('Y-m-d H:i:s');
$usuarioActual = $_SESSION["usuario"];
$sqlUserActual = "SELECT CodUsu FROM usuarios WHERE Nombre='$usuarioActual'";
$resultUserActual = $conexion->query($sqlUserActual); 
$totalPrecio=0;

foreach ($arrayCarrito as $producto) {
    $totalPrecio += $producto['precioFinal'];
}

if ($resultUserActual->num_rows > 0) {
    while ($fila = $resultUserActual -> fetch_assoc()) {
        $codUserActual= $fila["CodUsu"];
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

    //$descripcion = "Pedido del producto " . $codProducto . " - " . $producto['nombre'] . " con " . $unidades . " unidades";
   //$sqlInsertarHistorial = "INSERT INTO historialPedidos (CodUsu, Descripcion, Fecha) VALUES ($codUsuario, '$descripcion', '$fechaActual')";
    //$resultInsertHistorial = $conexion->query($sqlInsertarHistorial); 
}

unset($_SESSION["arrayCarrito"]);

header("Location: inicio.php");
exit;
?>