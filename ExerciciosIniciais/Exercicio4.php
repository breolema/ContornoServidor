<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8"/>
    <title> Exercicio4 </title>
</head>
<body>

<select id="numeros">

<?php
    for($i=1;$i<=10;$i++){
        echo '<option value=" '.$i.' ">'.$i.'</option>';
    }
?>

</body>
</html>