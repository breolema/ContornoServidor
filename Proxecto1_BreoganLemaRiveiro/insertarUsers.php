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
//datos do formulario
if (isset($_POST["usuario"]) && isset($_POST["nombre"]) && isset($_POST["correo"]) && isset($_POST["clave"]) && isset($_POST["pais"]) && isset($_POST["cp"]) && isset($_POST["ciudad"]) && isset($_POST["direccion"]) && isset($_POST["rol"])) {
  $usuario = $_POST["usuario"];
  $nombre = $_POST["nombre"];
  $correo = $_POST["correo"];
  $clave = $_POST["clave"];
  $claveCifrada = md5($clave);
  $pais = $_POST["pais"];
  $cp = $_POST["cp"];
  $ciudad = $_POST["ciudad"];
  $direccion = $_POST["direccion"];
  $rol = $_POST["rol"];
  $activo = isset($_POST['activo']) ? 1 : 0;

  //insertamos os usuarios
  $insert = "INSERT INTO `usuarios` (`Usuario`, `Nombre`, `Correo`, `Clave`,`Pais`, `CP`, `Ciudad`, `Direccion`, `Rol`, `Activo`) VALUES
      ('$usuario', '$nombre', '$correo', '$claveCifrada', '$pais', $cp, '$ciudad', '$direccion', $rol, $activo)";
  $result_Insert = $conexion->query($insert);

  if ($result_Insert) {
      $rexistroInsert = "INSERT INTO historialmodificaciones (CodUsuario,Descripcion) VALUES ('$codUserActual','O usuario $codUserActual dou de alta o usuario $nombre')";
      $resultRexistroInsert = $conexion->query($rexistroInsert);
      $_SESSION["mensaje"] = "Se añadió el usuario correctamente.";
  } else {
      $_SESSION["mensaje"] = "Error al añadir el usuario, compruebe si esta cubriendo los campos correctamente.";
  }
} else {
  $_SESSION["mensaje"] = "Error al recibir los datos del formulario.";
}

header("Location: darAltaUsuarios.php");

?>