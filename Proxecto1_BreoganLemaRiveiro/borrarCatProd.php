<?php
session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: inicioSesion.php");
    exit;
}

include_once("conexionbd.php");
error_reporting(E_ALL ^ E_WARNING);

$usuarioActual = $_SESSION["usuario"];
$sqlUserActual = "SELECT CodUsu FROM usuarios WHERE Nombre='$usuarioActual'";
$resultUserActual = $conexion->query($sqlUserActual);
if ($resultUserActual->num_rows > 0) {
    while ($fila = $resultUserActual->fetch_assoc()) {
        $codUserActual = $fila["CodUsu"];
    }
}



//borrar categoría
if (isset($_POST["codcat"])) {
    $codCategoria = $_POST["codcat"];

    //verificar si hay productos asociados a esta categoría
    $sqlProductos = "SELECT COUNT(*) AS cantidadProductos FROM productos WHERE CodCat = '$codCategoria'";
    $resultProductos = $conexion->query($sqlProductos);
    $filaProductos = $resultProductos->fetch_assoc();
    $cantidadProductos = $filaProductos["cantidadProductos"];

    if ($cantidadProductos > 0) {
        $_SESSION["mensaje"] = "No se puede borrar la categoría porque tiene productos asociados.";
    } else {
        //obtemos o nombre da categoria que imos eliminar
        $sqlnombreCat = "SELECT Nombre FROM categorias WHERE CodCat=$codCategoria";
            $resultNomCat = $conexion->query($sqlnombreCat);
            if ($resultNomCat->num_rows > 0) {
                while ($fila = $resultNomCat->fetch_assoc()) {
                    $nomCat = $fila["Nombre"];
                }
            }

        $sqlBorrarCategoria = "DELETE FROM categorias WHERE CodCat = '$codCategoria'";
        $resultBorrarCategoria = $conexion->query($sqlBorrarCategoria);

        if ($resultBorrarCategoria) {
            //facemos o rexistro na bd
            $rexistroDeleteCat = "INSERT INTO historialmodificaciones (CodUsuario,Descripcion) VALUES ('$codUserActual','O usuario $codUserActual borrou a categoria $nomCat')";
            $resultRexistroDeleteCat = $conexion->query($rexistroDeleteCat);
            $_SESSION["mensaje"] = "Categoría borrada exitosamente.";
        } else {
            $_SESSION["mensaje"] = "Error al borrar la categoría.";
        }
    }
    header("Location: categoriasAdmin.php");
    exit;

} else if (isset($_POST["codprod"])) {
    $codProducto = $_POST["codprod"];

    //verificamos si hai pedidos co producto que queremos eliminar
    $sqlPedidos = "SELECT COUNT(*) AS cantidadPedidos FROM pedidosproductos WHERE CodProd = '$codProducto'";
    $resultPedidos = $conexion->query($sqlPedidos);
    $filaPedidos = $resultPedidos->fetch_assoc();
    $cantidadPedidos = $filaPedidos["cantidadPedidos"];

    if ($cantidadPedidos > 0) {
        $_SESSION["mensaje"] = "No se puede borrar el producto porque está presente en pedidos.";
    } else {
        //obtemos o nombre do producto que imos eliminar
        $sqlnombreProd = "SELECT Nombre FROM productos WHERE CodProd=$codProducto";
        $resultNomProd = $conexion->query($sqlnombreProd);
        if ($resultNomProd->num_rows > 0) {
            while ($fila = $resultNomProd->fetch_assoc()) {
                $nomProd = $fila["Nombre"];
            }
        }

        $sqlBorrarProducto = "DELETE FROM productos WHERE CodProd = '$codProducto'";
        $resultBorrarProducto = $conexion->query($sqlBorrarProducto);

        if ($resultBorrarProducto) {
            //facemos o rexistro na bd
            $rexistroDeleteCat = "INSERT INTO historialmodificaciones (CodUsuario,Descripcion) VALUES ('$codUserActual','O usuario $codUserActual borrou o producto $nomProd')";
            $resultRexistroDeleteCat = $conexion->query($rexistroDeleteCat);
            $_SESSION["mensaje"] = "Producto borrado exitosamente.";
        } else {
            $_SESSION["mensaje"] = "Error al borrar el producto.";
        }
    }

    header("Location: productosAdmin.php");
    exit;
}


?>