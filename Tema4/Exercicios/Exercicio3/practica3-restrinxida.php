<?php
session_start();
if (isset($_SESSION["nombre"]) && isset($_SESSION["contrasena"])) {
    $nombre =$_SESSION["nombre"];
    $hash = $_SESSION["contrasena"];
    } else {
    header("Location: practica3-autentificacion.php");
    exit();
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Zona Restringida</title>
</head>
<body>
    <h2>Entrastes na zona restrinxida</h2>
</body>
</html>