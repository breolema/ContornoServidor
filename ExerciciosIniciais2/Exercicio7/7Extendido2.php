<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8"/>
    <title> Exercicio 7</title>

</head>
<body>
   <?php
   /*
    print "<pre>";
    print_r($_POST);
    print "</pre>";
    */


        $numero1 = $_POST['numero1'];
        $numero2 = $_POST['numero2'];
        $numero3 = $_POST['numero3'];
        $numero4 = $_POST['numero4'];
        $numero5 = $_POST['numero5'];
        $numero6 = $_POST['numero6'];
        $unAcerto=$_POST['unAcerto'];
        $dousAcerto=$_POST['dousAcerto'];
        $tresAcerto=$_POST['tresAcerto'];
        $catroAcerto=$_POST['catroAcerto'];
        $cincoAcerto=$_POST['cincoAcerto'];
        $seisAcerto=$_POST['seisAcerto'];
        $acertos0= 0;
        $acertos1= 0;
        $acertos2= 0;
        $acertos3= 0;
        $acertos4= 0;
        $acertos5= 0;
        $acertos6= 0;

        $tope = 6;  
        echo "<h1>Cantidade de veces necesarias para acertar</h1>";

        for ($i = 1; $i <= $veces; $i++) {
            $combinacion = array();
            $apuesta= array($numero1,$numero2,$numero3,$numero4,$numero5,$numero6);
            while (count($combinacion) < $tope) {
                $num = mt_rand(1, 49);
                if (!in_array($num, $combinacion)) {
                    $combinacion[] = $num;
                }
            }
            $acertos = count(array_intersect($apuesta,$combinacion));
            if($acertos==1){
                $acertos1++;
            } elseif ($acertos==2){
                $acertos2++;
            } elseif ($acertos==3){
                $acertos3++;
            } elseif ($acertos==4){
                $acertos4++;
            } elseif ($acertos==5){
                $acertos5++;
            } elseif ($acertos==6){
                $acertos6++;
            } else {
                $acertos0++;
            }

        }

        echo "0 acertos: $acertos0 veces<br>";
        echo "1 acerto: $acertos1 veces<br>";
        echo "2 acertos: $acertos2 veces<br>";
        echo "3 acertos: $acertos3 veces<br>";
        echo "4 acertos: $acertos4 veces<br>";
        echo "5 acertos: $acertos5 veces<br>";
        echo "6 acertos: $acertos6 veces<br>";


   ?>
    
</body>
</html>