<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8"/>
    <title> Exercicio 7</title>

</head>
<body>
    <h1>Combinacions loteria</h1>
   <?php
        $veces = 100;
        $tope = 6;  

        for ($i = 1; $i <= $veces; $i++) {
            echo "<br>Combinación $i: ";
            $combinacion = array();
            while (count($combinacion) < $tope) {
                $num = mt_rand(1, 49);
                if (!in_array($num, $combinacion)) {
                    $combinacion[] = $num;
                }  
            }  
            sort($combinacion);
            echo implode(" ", $combinacion);
        }
   ?>
    
</body>
</html>