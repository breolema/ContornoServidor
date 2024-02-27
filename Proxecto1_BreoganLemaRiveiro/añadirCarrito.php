<?php
session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: inicioSesion.php");
    exit;
}

if (isset($_SESSION["arrayCarrito"])) {
    $arrayCarrito = $_SESSION["arrayCarrito"];
} else {
    $arrayCarrito = [];
}

$cantidad = $_POST["cantidad"];
$codprod = $_POST["codprod"];
$precio = $_POST["precio"];
$precioFinalProducto = $cantidad * $precio;

$productoEncontrado = false;

foreach ($arrayCarrito as &$productoExistente) {
    if ($productoExistente["codprod"] == $codprod) {
        $productoExistente["cantidad"] += $cantidad;
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

    $arrayCarrito[] = $producto;
}

$_SESSION["arrayCarrito"] = $arrayCarrito;

header("Location: productos.php?codCat=$codprod");
?>