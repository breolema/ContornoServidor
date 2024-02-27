<?php
session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: inicioSesion.php");
    exit;
}

if (!isset($_SESSION["arrayCarrito"])) {
    $_SESSION["arrayCarrito"] = array();
}

$codcat = $_POST["codcat"];
$cantidad = $_POST["cantidad"];
$codprod = $_POST["codprod"];
$precio = $_POST["precio"];
$precioFinalProducto = $cantidad * $precio;

$productoEncontrado = false;

foreach ($_SESSION["arrayCarrito"] as &$productoExistente) {
    if ($productoExistente["codprod"] == $codprod) {
        $productoExistente["cantidad"] += $cantidad;
        $productoExistente["precioFinal"] += $precioFinalProducto;
        $productoEncontrado = true;
        break;
    }
}

if (!$productoEncontrado) {
    $producto = array(
        "codprod" => $codprod,
        "cantidad" => $cantidad,
        "precio" => $precio,
        "precioFinal" => $precioFinalProducto
    );

    $_SESSION["arrayCarrito"][] = $producto;
}

header("Location: productos.php?codCat=$codcat");
?>
