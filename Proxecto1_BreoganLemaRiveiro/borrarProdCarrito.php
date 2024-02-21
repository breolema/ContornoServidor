<?php
session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: inicioSesion.php");
    exit;
}

if (!isset($_POST["codprod"])) {
    header("Location: carrito.php");
    exit;
}

$codprod = $_POST["codprod"];



function buscarProductoEnCarrito($codprod) {
    if (isset($_SESSION["arrayCarrito"])) {
        foreach ($_SESSION["arrayCarrito"] as $index => $producto) {
            if ($producto["codprod"] == $codprod) {
                return $index;
            }
        }
    }
    return false;
}

?>
