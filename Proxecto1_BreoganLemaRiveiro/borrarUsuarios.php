<?php
    session_start();

    if (!isset($_SESSION["usuario"])) {
        header("Location: inicioSesion.php");
        exit;
    }


    $usuarioBorrar = $_GET["codUsu"];

    $conexion = mysqli_connect("localhost", "root", "", "supermercado");
    $usuarioActual = $_SESSION["usuario"];
    $sqlUserActual = "SELECT CodUsu FROM usuarios WHERE Nombre='$usuarioActual'";
    $resultUserActual = $conexion->query($sqlUserActual); 

   
    if ($resultUserActual->num_rows > 0) {
        while ($fila = $resultUserActual -> fetch_assoc()) {
            $codUserActual= $fila["CodUsu"];
        }
        print $codUserActual;
        print $usuarioBorrar;
        if($codUserActual!=$usuarioBorrar){
            $deleteUser = "DELETE FROM usuarios WHERE CodUsu=$usuarioBorrar";
            $resultDeleteUser = $conexion->query($deleteUser);
        }
    }

    header("Location: darAltaUsuarios.php");
    
    ?>