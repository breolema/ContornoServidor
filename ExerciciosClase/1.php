<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8"/>
    <title> Exercicio 1</title>
</head>
<body>

   <?php
   //funcion recursiva
        function factorialRecursiva($n){
            if ($n<=1) return 1;
            else return $n*factorialRecursiva($n-1);
        }
        echo factorialRecursiva(5);

   //función iterativa
        function factorialIterativo($n){
            $res=1;
            for($i=1;$i<=$n;$i++){
                $res*=$i;
            }
            return $res;
        }

        echo "<br>" . factorialIterativo(5);
    ?>

</body>
</html>