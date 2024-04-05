<?php
session_start();

if (!isset ($_SESSION["usuario"])) {
  header("Location: inicioSesion.php");
  exit;
}

$conexion = mysqli_connect("localhost", "root", "", "supermercado");
error_reporting(E_ALL ^ E_WARNING);

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

//Inserccion de usuarios
$insert = "INSERT INTO `usuarios` (`Nombre`, `Correo`, `Clave`,`Pais`, `CP`, `Ciudad`, `Direccion`, `Rol`, `Activo`) VALUES
    ('$nombre', '$correo', '$claveCifrada', '$pais', $cp, '$ciudad', '$direccion', $rol, $activo)";

$result_Insert = $conexion->query($insert);

if ($result_Insert) {
    $_SESSION["mensaje"] = "Se añadió el usuario correctamente.";
} else {
    $_SESSION["mensaje"] = "Error al añadir el usuario, compruebe si esta cubriendo los campos correctamente.";
}

header("Location: darAltaUsuarios.php");

?>