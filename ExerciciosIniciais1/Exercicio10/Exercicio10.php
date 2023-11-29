<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8"/>
    <title> Exercicio 9</title>
    
    <style>
        th{
            background-color: black;
            color: lightblue;
        }
    </style>

</head>
<body>

    </form>

   <?php
    $fin=50000;
    $columnas=16;
    $contador=0;

    echo "<table border=1>";
    echo "<tr>";
           for($i=1;$i<=8;$i++){
                echo "<th>Código</th>";
                echo "<th>Valor</th>";
           }
    echo "</tr>";
    echo "<tr>";
        for($j=1;$j<=$fin;$j++){
            if($contador == 8){
                echo "</tr>";
                echo "<tr>";
                $contador=0;    
            }    
            $contador++;    
            echo "<td>" . $j . "</td>";
            echo "<td>". "&#" . $j ."</td>";
        }
    echo "</table>";
    ?>

</body>
</html>