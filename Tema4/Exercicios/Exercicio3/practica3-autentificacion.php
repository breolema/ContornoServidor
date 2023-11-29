<?php
session_start();
if (isset($_POST["nombre"]) && isset($_POST["contrasena"])) {
    $nombre =$_POST["nombre"];
    $contrasena = $_POST["contrasena"];
    if($nombre=="admin" && $contrasena=="123456"){
        $_SESSION["nombre"]=$nombre;
        $_SESSION["contrasena"]=$contrasena;
        header("Location:practica3-restrinxida.php");
    } else {
        echo "<h1>Error nos datos!</h1>";
    }
}
?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8"/>
    <title>Autenticación</title>
</head>
<body>
<h2>Autenticación</h2>
<form action="practica3-autentificacion.php" method="POST">
    <p>Nombre de usuario: <input type="text" name="nombre"></p>
    <p>Contraseña: <input type="password" name="contrasena"></p>
    <input type="submit" value="Comprobar">
</form>
</body>
</html>