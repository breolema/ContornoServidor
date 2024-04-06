<?php
session_start();

if (!isset($_SESSION["usuario"])) {
  header("Location: inicioSesion.php");
  exit;
}

include_once("conexionbd.php");

if (!isset($_POST["codigoPedido"])) {
  header("Location: pedidos.php");
  exit;
}

$codPedido = $_POST["codigoPedido"];

//sacamos os datos do pedido
$productosPedido="SELECT CodProd, Unidades FROM pedidosproductos WHERE CodPed = $codPedido";
$resultProductosPedido=$conexion->query($productosPedido);

//actualizamos stock
while ($fila=$resultProductosPedido->fetch_assoc()) {
  $codProducto=$fila["CodProd"];
  $unidades=$fila["Unidades"];

  //sacamos o stock actual do producto
  $consultaStock="SELECT Stock FROM productos WHERE CodProd = $codProducto";
  $resultConsultaStock=$conexion->query($consultaStock);
  $filaStock=$resultConsultaStock->fetch_assoc();
  $stockActual=$filaStock["Stock"];

  //sumamoslle a cantidad do producto do pedido
  $nuevoStock=$stockActual + $unidades;
  //actualizamos cantidades
  $actualizarStockProducto="UPDATE productos SET Stock = $nuevoStock WHERE CodProd = $codProducto";
  $conexion->query($actualizarStockProducto);
}

//eliminamos os productos do pedido
$eliminarProductosPedido="DELETE FROM pedidosproductos WHERE CodPed = $codPedido";
$resultEliminarProductos=$conexion->query($eliminarProductosPedido);

//eliminamos pedido
$eliminarPedido="DELETE FROM pedidos WHERE CodPed = $codPedido";
$resultEliminarPedido=$conexion->query($eliminarPedido);

header("Location:todosPedidos.php");
?>
