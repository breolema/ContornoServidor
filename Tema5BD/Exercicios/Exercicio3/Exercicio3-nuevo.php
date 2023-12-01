<html>
<head>
<title>Exercicio3-nuevo</title>
</head>
<body>
    <?php

$conexion=mysqli_connect("localhost","root","","mensajes");

    if(isset($_GET["userNuevo"]) && isset($_GET["contrNueva"]) && isset($_GET["contrNuevaRepetir"])){
        $usuario = $_GET["userNuevo"];
        $contr = $_GET["contrNueva"];
        $contrRept=  $_GET["contrNuevaRepetir"];

        if($contr==$contrRept){
            $sql = "INSERT INTO usuarios (usuario, pass) VALUES ('$usuario', '$contr')";

            if ($conexion->query($sql) === TRUE) {
                header("Location:Exercicio3-buzon.html");
            }
        } else {
            echo "A contraseña non é igual nos dous campos";
        }
}

    ?>
</body>
</html>