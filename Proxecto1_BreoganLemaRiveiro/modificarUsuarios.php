<?php
session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: inicioSesion.php");
    exit;
}

include_once("conexionbd.php");
//comprobamos si recibimos os datos
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
        //comprobamos si o usuario que vamos facer o update é diferente o actual
        if($codUsu!=$codUserActual){
            //comprobamos si recibimos datos de clave, o que significa que queremos cambiala
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
            } else { //si non recibimos a clave facemos este update
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
            $rexistroUpdate="INSERT INTO historialmodificaciones (CodUsuario,Descripcion) VALUES ('$codUserActual','O usuario $codUserActual modificou o usuario $nombre')";
            $resultRexistroUpdate = $conexion->query($rexistroUpdate);
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