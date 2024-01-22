<?php
    session_start();
    $conexion=mysqli_connect("localhost","root","","supermercado");

    if(isset($_GET["usuario"]) && isset($_GET["clave"])){
        $usuario=$_GET["usuario"];
        $clave=$_GET["clave"];
        $sql="SELECT nombre,clave FROM usuarios WHERE usuario='$usuario'";
        $res=$conexion->query($sql);
        if($res==false){
            header("Location:entrada.php");
        } else {
            $fila=$res->fetch_assoc();
            if($fila){
                $_SESSION["usuario"]=$fila["usuario"];
                $_SESSION["clave"]=$fila["clave"]; 
                $res->close();
                header("Location:Exercicio3-buzon.php");
            }
        }
    } else {
        header("Location:Exercicio3-index.php");
    }


    ?>