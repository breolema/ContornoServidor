<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8"/>
    <title> Exercicio 5</title>
</head>
<body>
    <form method="get">
    <p>Escriba el numero de asteriscos: <input type="number" name="numero"></p>
    <p><input type="submit" value="Enviar"></p>
   
   <?php
    $numeroAsteriscos=0;
    if(isset($_GET["numero"])){
        $n=$_GET["numero"];
        if(is_numeric($n)){
            $resto=$n-(int)$n;
            if($resto==0){
            for($i=1;$i<=$n;$i++){
                $numeroAsteriscos++;
                echo  "*";
            }
        } else {
            echo "Escribe un numero enteiro positivo";
        }
    }
}
    ?>

</body>
</html>