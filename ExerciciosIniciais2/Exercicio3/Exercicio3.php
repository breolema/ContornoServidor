<?php
        $arraycolor=array();

        for($i=0;$i<10;$i++){
            $rojo=mt_rand(0, 255);
            $verde=mt_rand(0, 255);
            $azul=mt_rand(0, 255);
            $arraycolor[$i]="background-color: rgb($rojo,$verde,$azul)";
        }        
    ?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8"/>
    <title> Exercicio 3</title>
    <style>
        div{
            position:fixed;
            width:100%;
            height:1%;
        }
        body{
            height: 1080px;
            margin:0;
            font-size:1px;
        }
</style>

</head>
<body>

   <?php
        $top=0;

        for($i=1;$i<=10;$i++){
            foreach($arraycolor as $j=>$color){
                echo "<div style='$color;top:$top%;'></div>";
                $top++;
            }
        }
   ?>
    
</body>
</html>