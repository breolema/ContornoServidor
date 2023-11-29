<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8"/>
    <title> Exercicio 6</title>

</head>
<body>
   <?php
   print "<pre>";
   print_r($_POST);
   print "</pre>";
       $texto= $_POST['texto'];
       $funcion=$_POST['funcion'];
       $clave=$_POST['clave'];

    if(strlen($texto)<10){
        echo "<p>A cadena de texto ten que ter mais de 10 dixitos!</p>";
    } elseif($clave<0 || $clave>99){
        echo "<p>A clave debe ser un numero entre 1 e 99!</p>";
    }else{
        if($funcion=="encriptar"){
            $aux=" ";
            for($i=0;$i<strlen($texto);$i++){
                $aux.=chr(ord($texto[$i])+$clave);
            }
            echo "<p>El texto cifrado es: <strong>$aux</strong></p>";
        } else {
            $aux=" ";
            for($i=0;$i<strlen($texto);$i++){
                $aux.=chr(ord($texto[$i])-$clave);
            }
            echo "<p>El texto descifrado es: <strong>$aux</strong></p>";
         }
     }

   ?>
    
</body>
</html>