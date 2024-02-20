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

$cantidad = $_POST["cantidad"];
$codprod = $_POST["codprod"];
$precio = $_POST["precio"];
$precioFinalProducto = $cantidad*$precio;
    
$producto = array(
    "codprod" => $codprod,
    "cantidad" => $cantidad,
    "precio" => $precio,
    "precioFinal" => $precioFinalProducto
);

$arrayCarrito[] = $producto;

$_SESSION["arrayCarrito"] = $arrayCarrito;
?>