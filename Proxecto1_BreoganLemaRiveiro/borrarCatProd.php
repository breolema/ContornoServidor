<?php
session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: inicioSesion.php");
    exit;
}

$conexion = mysqli_connect("localhost", "root", "", "supermercado");
error_reporting(E_ALL ^ E_WARNING);

// Borrar categoría
if (isset($_POST["codcat"])) {
    $codCategoria = $_POST["codcat"];

    // Verificar si hay productos asociados a esta categoría
    $sqlProductos = "SELECT COUNT(*) AS cantidadProductos FROM productos WHERE CodCat = '$codCategoria'";
    $resultProductos = $conexion->query($sqlProductos);
    $filaProductos = $resultProductos->fetch_assoc();
    $cantidadProductos = $filaProductos["cantidadProductos"];

    if ($cantidadProductos > 0) {
        $_SESSION["mensaje"] = "No se puede borrar la categoría porque tiene productos asociados.";
    } else {
        $sqlBorrarCategoria = "DELETE FROM categorias WHERE CodCat = '$codCategoria'";
        $resultBorrarCategoria = $conexion->query($sqlBorrarCategoria);

        if ($resultBorrarCategoria) {
            $_SESSION["mensaje"] = "Categoría borrada exitosamente.";
        } else {
            $_SESSION["mensaje"] = "Error al borrar la categoría.";
        }
    }
    header("Location: categoriasAdmin.php");
    exit;

} else if (isset($_POST["codprod"])) {
    $codProducto = $_POST["codprod"];

    // Verificar si hay pedidos que contienen este producto
    $sqlPedidos = "SELECT COUNT(*) AS cantidadPedidos FROM pedidosproductos WHERE CodProd = '$codProducto'";
    $resultPedidos = $conexion->query($sqlPedidos);
    $filaPedidos = $resultPedidos->fetch_assoc();
    $cantidadPedidos = $filaPedidos["cantidadPedidos"];

    if ($cantidadPedidos > 0) {
        $_SESSION["mensaje"] = "No se puede borrar el producto porque está presente en pedidos.";
    } else {
        $sqlBorrarProducto = "DELETE FROM productos WHERE CodProd = '$codProducto'";
        $resultBorrarProducto = $conexion->query($sqlBorrarProducto);

        if ($resultBorrarProducto) {
            $_SESSION["mensaje"] = "Producto borrado exitosamente.";
        } else {
            $_SESSION["mensaje"] = "Error al borrar el producto.";
        }
    }

    header("Location: productosAdmin.php");
    exit;
}


?>