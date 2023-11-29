<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8"/>
    <title> Exercicio 1</title>
</head>
<body>
    <h1>Adiviña o numero</h1>
    <form method="get">
        <p>Número:  <input type="number" name="numero"><br>
        <input type="hidden" name="intentos" value="<?php if (isset($_GET['intentos'])) {
                                                                                                        $_GET['intentos'] = $_GET['intentos'] + 1;
                                                                                                    } else {
                                                                                                        $_GET['intentos'] = 0;
                                                                                                    } 
                                                                                                    echo $_GET['intentos'];?>">
        <input type="hidden" name="numeroSecreto" value="<?php if (!isset($_GET['numeroSecreto'])) {
                                                                                                                    $_GET['numeroSecreto'] = rand(0, 10);
                                                                                                                  }
                                                                                                                    echo $_GET['numeroSecreto'];?>">
        <input type="submit" value="Enviar"></p>
    </form>
   <?php
         if(isset($_GET["numero"])){
            $numero=$_GET["numero"];
            $numeroSecreto=$_GET['numeroSecreto'];
            $intentos=$_GET['intentos'];
            if ($numero > $numeroSecreto) {
                echo "O número é menor";
            } elseif ($numero < $numeroSecreto) {
                echo "O número é maior";
            } else {
                echo "Parabéns! Atinaches <br>";
                echo "Levouche $intentos intentos";
            }
         }
   ?>
    
</body>
</html>