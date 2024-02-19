<?php
session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: inicioSesion.php");
    exit;
}

$conexion = mysqli_connect("localhost", "root", "", "supermercado");

$usuarioActual = $_SESSION["usuario"];
$codUsuActual = "SELECT codusu FROM usuarios WHERE nombre=''$usuarioActual";
$resultCodUsuActual = $conexion->query($codUsuActual);

if ($resultCodUsuActual->num_rows > 0) {
    $usuarioActual  = mysqli_fetch_assoc($resultCodUsuActual);
    $codUsuActual = $usuarioActual["CodUsu"];

    if(isset($_GET["codUsu"])) {
        $codUsuBorrar = $_GET["codUsu"];

        if($codUsuActual == $codUsuBorrar){
            header("Location: darAltaUsuarios.php");
            exit;
        } else {
            $deleteQuery = "DELETE FROM usuarios WHERE CodUsu = '$codUsuBorrar'";
            $resultDelete = $conexion->query($deleteQuery);
            header("Location: darAltaUsuarios.php");
        }

    }else {
        header("Location: darAltaUsuarios.php");
        exit;
    }

} else {
    header("Location: darAltaUsuarios.php");
    exit;
}


?>
