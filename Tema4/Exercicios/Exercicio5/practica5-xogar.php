<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de palabras</title>
</head>
<body>
    <h1>Recorda as palabras</h1>

    <?php
        include "practica5-lista.php";

        shuffle($lista);

        $palabras=array();

        for($i=0;$i<=5;$i++){
            array_push($palabras,$lista[$i]);
            echo "<h2>" .  $lista[$i] . "</h2>";
        }
    ?>
</body>
</html>