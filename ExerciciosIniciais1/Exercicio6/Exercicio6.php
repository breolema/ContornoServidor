<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8"/>
    <title> Exercicio 6</title>
</head>
<body>
    <form method="get">
    <p>Escriba el numero de columnas: <input type="number" name="columnas"></p>
    <p>Escriba el numero de filas: <input type="number" name="filas"></p>
    <p><input type="submit" value="Enviar"></p>
   
   <?php
    if(isset($_GET["columnas"]) && isset($_GET["filas"])){
        $c=$_GET["columnas"];
        $f=$_GET["filas"];
        if($c>=1 && $f>=1){
            echo "<table border=1";
            for($i=1;$i<=$f;$i++){
                echo "<tr>";
                for($j=1;$j<=$c;$j++){
                    echo "<td>" . $j . "</td>";
                }
                echo "</tr>";
            }
        } else {
            echo "<h1>Introduce un numero entero mayor que 1</h1>";
        }
    }
    echo "</table>"
    ?>

</body>
</html>