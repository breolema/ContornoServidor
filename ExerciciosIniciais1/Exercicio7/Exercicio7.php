<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8"/>
    <title> Exercicio 7</title>
</head>
<body>
   <?php
    $columnas=5;
    $mil=200;
    $numero=1;

      echo "<table border=1";
            for($i=1;$i<=$mil;$i++){
                echo "<tr>";
                for($j=1;$j<=$columnas;$j++){
                    echo "<td>" . $numero++ . "</td>";
                }
                echo "</tr>";
            }
    
    echo "</table>"
    ?>

</body>
</html>