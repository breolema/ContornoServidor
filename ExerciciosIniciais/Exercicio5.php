<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8"/>
    <title> Exercicio5 </title>
</head>
<body>

<?php
    echo "<table border=1>";
    echo "<tr>";
    echo "<td>X</td>";
    for($i=1;$i<=10;$i++){
        echo "<td>$i</td>";
    }
    echo "</tr>";
    for($i=1;$i<=10;$i++){
        echo "<tr>";
            echo "<td>$i</td>";
            for($j=1;$j<=10;$j++){
                echo "<td>".$j*$i."</td>";
            }
        echo "</tr>";
    }
    echo "</table>";
?>

</body>
</html>