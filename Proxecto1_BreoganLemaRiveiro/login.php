<?php
    session_start();
    $conexion=mysqli_connect("localhost","root","","supermercado");

    if(isset($_POST["usuario"]) && isset($_POST["clave"])){
        $usuario=$_POST["usuario"];
        $clave=$_POST["clave"];
        $claveEncriptada = md5($clave);
        $sql="SELECT nombre,clave FROM usuarios WHERE nombre='$usuario' && clave='$claveEncriptada' && activo=true";
        $res=$conexion->query($sql);
        if($res==false){
            header("Location:inicioSesion.php");
        } else {
            $fila=$res->fetch_assoc();
            if($fila){
                $claveSesion=$_SESSION["clave"];
                $_SESSION["usuario"]=$fila["nombre"];
                $claveSesion=$fila["clave"]; 
                $res->close();
                header("Location:paginaCategorias.php");
            }
        }
    } else {
        header("Location:inicioSesion.php");
    }


    ?>