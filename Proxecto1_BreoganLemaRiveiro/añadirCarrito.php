<?php
session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: inicioSesion.php");
    exit;
}

//comprobamos si existe xa un arrayCarrito creado na sesion, si non creamolo
if (!isset($_SESSION["arrayCarrito"])) {
    $_SESSION["arrayCarrito"] = array();
}

//obtemos os datos do formulario
$codcat = $_POST["codcat"];
$cantidad = $_POST["cantidad"];
$codprod = $_POST["codprod"];
$precio = $_POST["precio"];
$precioFinalProducto = $cantidad * $precio;

$productoEncontrado = false;

/*comprobamos si o producto novo que queremos añadir xa esta no array,
si este xa existe sumamos as cantidades e o precio*/
foreach ($_SESSION["arrayCarrito"] as &$productoExistente) {
    if ($productoExistente["codprod"] == $codprod) {
        $productoExistente["cantidad"] += $cantidad;
        $productoExistente["precioFinal"] += $precioFinalProducto;
        //desta maneira facemos saber o programa que xa exite ese producto
        $productoEncontrado = true;
        break;
    }
}

//si non encontra o producto o que facemos é añadilo
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
