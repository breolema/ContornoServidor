<?php
session_start();

if (!isset($_SESSION["usuario"])) {
  header("Location: inicioSesion.php");
  exit;
}

$conexion = mysqli_connect("localhost", "root", "", "supermercado");

if (!isset($_POST["codigoPedido"])) {
  header("Location: pedidos.php");
  exit;
}

$codPedido = $_POST["codigoPedido"];

$eliminarProductosPedido = "DELETE FROM pedidosproductos WHERE CodPed = $codPedido";
$resultEliminarProductos = $conexion->query($eliminarProductosPedido);

$eliminarPedido = "DELETE FROM pedidos WHERE CodPed = $codPedido";
$resultEliminarPedido = $conexion->query($eliminarPedido);

header("Location: todosPedidos.php");
exit;
?>