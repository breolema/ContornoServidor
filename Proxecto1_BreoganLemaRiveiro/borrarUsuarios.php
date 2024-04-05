<?php
session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: inicioSesion.php");
    exit;
}

$usuarioBorrar = $_GET["codUsu"];

$conexion = mysqli_connect("localhost", "root", "", "supermercado");
//sacamos codigo usuario actual
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
        $_SESSION["mensaje"] = "El usuario fue borrado correctamente.";
    } else {
        $_SESSION["mensaje"] = "No puede borrar el usuario actual.";
    }
}

header("Location: darAltaUsuarios.php");

?>