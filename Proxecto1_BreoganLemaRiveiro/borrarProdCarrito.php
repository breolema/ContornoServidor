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

$codigo = buscarProductoEnCarrito($codprod);

if ($codigo !== false) {
    unset($_SESSION["arrayCarrito"][$codigo]);
    $_SESSION["arrayCarrito"] = array_values($_SESSION["arrayCarrito"]);
}

header("Location: carrito.php");
exit;

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
