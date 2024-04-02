<?php
session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: inicioSesion.php");
    exit;
}

$conexion = mysqli_connect("localhost", "root", "", "supermercado");

if (isset($_POST["codUsu"]) && isset($_POST["nombre"]) && isset($_POST["correo"]) && isset($_POST["pais"]) && isset($_POST["cp"]) && isset($_POST["ciudad"]) && isset($_POST["direccion"]) && isset($_POST["rol"])) {
    $usuarioActual = $_SESSION["usuario"];
    $sqlUserActual = "SELECT CodUsu FROM usuarios WHERE Nombre='$usuarioActual'";
    $resultUserActual = $conexion->query($sqlUserActual);

    $codUsu = $_POST["codUsu"];
    $nombre = $_POST["nombre"];
    $correo = $_POST["correo"];
    $pais = $_POST["pais"];
    $cp = $_POST["cp"];
    $ciudad = $_POST["ciudad"];
    $direccion = $_POST["direccion"];
    $rol = $_POST["rol"];
    $activo = isset($_POST['activo']) ? 1 : 0;

    if($resultUserActual->num_rows > 0){
        while ($fila = $resultUserActual->fetch_assoc()) {
            $codUserActual = $fila["CodUsu"];
        }
        if($codUsu!=$codUserActual){
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
            $_SESSION["mensaje"] = "Usuario modificado correctamente.";
        } else {
            $_SESSION["mensaje"] = "No puede modificar el usuario actual.";
        }
    }
    header("Location: darAltaUsuarios.php");
    exit;
} else {
    header("Location: darAltaUsuarios.php");
}

?>