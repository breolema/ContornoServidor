<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8"/>
    <title> Exercicio 3</title>
</head>
<body>

<form action="Exercicio3.php">
        <p>Escriba un numero: <input type="text" name="numero"></p>
        <p><input type="submit" value="Enviar"></p>
    </form>

<?php
    if(isset($_GET["numero"])){
        $n=$_GET["numero"];
        if(is_numeric($n)){
            $resto=$n-(int)$n;
            if($resto==0){
                echo "<h1>El numero es entero</h1>";
            } else {
                echo "<h1>El numero es decimal</h1>";
            }
        } else{
            echo "<h1>No se ha recibido un numero</h1>";
        }
        echo "<a href='practica3.html'>Volver</a>";
    } else {
        header("location:Exercicio3.html");
    }
?>

</body>
</html>