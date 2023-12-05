<html>
<head>
<title>Exercicio3-login</title>
</head>
<body>
    <?php
    session_start();
    $conexion=mysqli_connect("localhost","root","","mensajes");

    if(isset($_GET["usuario"]) && isset($_GET["contr"])){
        $usuario=$_GET["usuario"];
        $contr=$_GET["contr"];
        $sql="SELECT usuario,pass FROM usuarios WHERE usuario='$usuario'";
        $res=$conexion->query($sql);
        if($res==false){
            header("Location:Exercicio3-index.php");
        } else {
            $fila=$res->fetch_assoc();
            if($fila){
                $_SESSION["usuario"]=$fila["usuario"];
                $_SESSION["contr"]=$fila["contr"]; 
                $res->close();
                header("Location:Exercicio3-buzon.php");
            }
        }
    } else {
        header("Location:Exercicio3-index.php");
    }


    ?>
</body>
</html>