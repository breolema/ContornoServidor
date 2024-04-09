<?php
session_start();

if (!isset($_SESSION["usuarioadmin"])) {
    header("Location: inicioSesion.php");
    exit;
}

$usuarioBorrar = $_GET["codUsu"];

include_once("conexionbd.php");

//comprobamos si o usuario que intentamos boorrar ten pedidos creados
$comprobacionPedidos="SELECT * FROM pedidos WHERE CodUsuario=$usuarioBorrar";
$resultComprobacionPedidos = $conexion->query($comprobacionPedidos);

//si este ten pedidos creados devolve un mensaje
if($resultComprobacionPedidos->num_rows > 0){
    $_SESSION["mensaje"] = "El usuario no puede ser borrado ya que tiene pedidos hechos.";
    header("Location: darAltaUsuarios.php");
}

//sacamos codigo do usuario actual
$usuarioActual = $_SESSION["usuario"];
$sqlUserActual = "SELECT CodUsu FROM usuarios WHERE Nombre='$usuarioActual'";
$resultUserActual = $conexion->query($sqlUserActual);
if ($resultUserActual->num_rows > 0) {
    while ($fila = $resultUserActual->fetch_assoc()) {
        $codUserActual = $fila["CodUsu"];
    }
    //comparamos se o codigo do usuario actual é diferente o do usuario a borrar
    if ($codUserActual != $usuarioBorrar) {
        $deleteUser = "DELETE FROM usuarios WHERE CodUsu=$usuarioBorrar";
        $resultDeleteUser = $conexion->query($deleteUser);
        if ($resultDeleteUser) {
            $resxistroDelete="INSERT INTO historialmodificaciones (CodUsuario,Descripcion) VALUES ('$codUserActual','O usuario $codUserActual eliminou o usuario $usuarioBorrar')";
            $resultResxistroDelete = $conexion->query($resxistroDelete);
            $_SESSION["mensaje"] = "El usuario fue borrado correctamente.";
        } else {
            $_SESSION["mensaje"] = "Error al intentar borrar el usuario.";
        }
    } else {
        $_SESSION["mensaje"] = "No puede borrar el usuario actual.";
    }
}

header("Location: darAltaUsuarios.php");

?>