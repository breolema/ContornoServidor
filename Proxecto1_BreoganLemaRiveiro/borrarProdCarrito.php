<?php
session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: inicioSesion.php");
    exit;
}

//verificamos que recibimos o codigo do producto
if (!isset($_POST["codprod"])) {
    header("Location: carrito.php");
    exit;
}

$codprod = $_POST["codprod"];

//buscamos o producto no carro e eliminamolo
if (isset($_SESSION["arrayCarrito"])) {
    foreach ($_SESSION["arrayCarrito"] as $index => $producto) {
        if ($producto["codprod"] == $codprod) {
            unset($_SESSION["arrayCarrito"][$index]);
            $_SESSION["arrayCarrito"] = array_values($_SESSION["arrayCarrito"]);
            break;
        }
    }
}

header("Location: carrito.php");
exit;
?>
