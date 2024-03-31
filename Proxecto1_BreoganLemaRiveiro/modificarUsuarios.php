<?php
session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: inicioSesion.php");
    exit;
}

$conexion = mysqli_connect("localhost", "root", "", "supermercado");

if (isset($_POST["codUsu"]) && isset($_POST["nombre"]) && isset($_POST["correo"]) && isset($_POST["pais"]) && isset($_POST["cp"]) && isset($_POST["ciudad"]) && isset($_POST["direccion"]) && isset($_POST["rol"])) {
    $codUsu = $_POST["codUsu"];
    $nombre = $_POST["nombre"];
    $correo = $_POST["correo"];
    $pais = $_POST["pais"];
    $cp = $_POST["cp"];
    $ciudad = $_POST["ciudad"];
    $direccion = $_POST["direccion"];
    $rol = $_POST["rol"];
    $activo = isset($_POST['activo']) ? 1 : 0;
    if (isset($_POST["clave"])) {
        $clave = $_POST["clave"];
        $claveCifrada = md5($clave);

        $update = "UPDATE usuarios SET 
                            Nombre = '$nombre',
                            Correo = '$correo',
                            Clave = '$claveCifrada',
                            Pais = '$pais',
                            CP = $cp,
                            Ciudad = '$ciudad',
                            Direccion = '$direccion',
                            Rol = $rol,
                            Activo = $activo
                            WHERE CodUsu = $codUsu";
    } else {
        $update = "UPDATE usuarios SET 
                            Nombre = '$nombre',
                            Correo = '$correo',
                            Pais = '$pais',
                            CP = $cp,
                            Ciudad = '$ciudad',
                            Direccion = '$direccion',
                            Rol = $rol,
                            Activo = $activo
                            WHERE CodUsu = $codUsu";
    }

    $resultUpdate = $conexion->query($update);

    if ($resultUpdate) {
        $mensaje = "Se actualizó el usuario correctamente.";
    } else {
        $mensaje = "Error al actualizar el usuario. Por favor, inténtelo de nuevo.";
    }
    header("Location: darAltaUsuarios.php?mensaje=" . urlencode($mensaje));
    exit;
} else {
    header("Location: darAltaUsuarios.php");
}

?>