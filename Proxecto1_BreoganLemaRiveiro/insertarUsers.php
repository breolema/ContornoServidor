<?php
session_start();

if (!isset ($_SESSION["usuarioadmin"])) {
  header("Location: inicioSesion.php");
  exit;
}

include_once("conexionbd.php");
error_reporting(E_ALL ^ E_WARNING);

//sacamos o usuario actual
$usuarioActual = $_SESSION["usuario"];
$sqlUserActual = "SELECT CodUsu FROM usuarios WHERE Nombre='$usuarioActual'";
$resultUserActual = $conexion->query($sqlUserActual);
if ($resultUserActual->num_rows > 0) {
    while ($fila = $resultUserActual->fetch_assoc()) {
        $codUserActual = $fila["CodUsu"];
    }
}

//datos do formulario
$nombre = $_POST["nombre"];
$correo = $_POST["correo"];
$clave = $_POST["clave"];
$claveCifrada = md5($clave);
$pais = $_POST["pais"];
$cp = $_POST["cp"];
$ciudad = $_POST["ciudad"];
$direccion = $_POST["direccion"];
$rol = $_POST["rol"];
if (isset ($_POST['activo'])) {
  $activo = 1;
} else {
  $activo = 0;
}

//insertamos os usuarios
$insert = "INSERT INTO `usuarios` (`Nombre`, `Correo`, `Clave`,`Pais`, `CP`, `Ciudad`, `Direccion`, `Rol`, `Activo`) VALUES
    ('$nombre', '$correo', '$claveCifrada', '$pais', $cp, '$ciudad', '$direccion', $rol, $activo)";
$result_Insert = $conexion->query($insert);

if ($result_Insert) {
    $rexistroInsert="INSERT INTO historialmodificaciones (CodUsuario,Descripcion) VALUES ('$codUserActual','O usuario $codUserActual dou de alta o usuario $nombre')";
    $resultRexistroInsert = $conexion->query($rexistroInsert);
    $_SESSION["mensaje"] = "Se añadió el usuario correctamente.";
} else {
    $_SESSION["mensaje"] = "Error al añadir el usuario, compruebe si esta cubriendo los campos correctamente.";
}

header("Location: darAltaUsuarios.php");

?>