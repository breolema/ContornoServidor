<?php
//funcionalidad do inicioSesion
session_start();
include_once("conexionbd.php");

if (isset($_POST["usuario"]) && isset($_POST["clave"])) {
    $usuario = $_POST["usuario"];
    $clave = $_POST["clave"];
    //encriptamos a clave para comparar ca da bd
    $claveEncriptada = md5($clave);
    $sql = "SELECT nombre, clave, rol FROM usuarios WHERE nombre='$usuario' && clave='$claveEncriptada' && activo=true";
    $res = $conexion->query($sql);
    if ($res->num_rows == 0) {
        header("Location:inicioSesion.php");
    } else {
        $fila = $res->fetch_assoc();
        if ($fila) {
            $rol = $fila["rol"];
            $_SESSION["usuario"] = $fila["nombre"];
            $_SESSION["rol"] = $rol;
            $res->close();
            //comprobamos o rol dos usuarios
            if ($rol == 1) {
                $_SESSION["usuarioadmin"]= $_SESSION["usuario"];
                header("Location: todosPedidos.php");
            } else {
                header("Location: inicio.php");
            }
        }
    }
} else {
    header("Location:inicioSesion.php");
}
?>