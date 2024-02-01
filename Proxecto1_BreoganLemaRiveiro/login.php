<?php
//Funcionalidade do inicioSesion.php
session_start();
$conexion = mysqli_connect("localhost", "root", "", "supermercado");

if (isset($_POST["usuario"]) && isset($_POST["clave"])) {
    $usuario = $_POST["usuario"];
    $clave = $_POST["clave"];
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
            if ($rol == 1) {
                header("Location: paginaGeneralAdmin.php");
            } else {
                header("Location: inicio.php");
            }
        }
    }
} else {
    header("Location:inicioSesion.php");
}
?>
